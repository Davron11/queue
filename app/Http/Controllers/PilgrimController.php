<?php

namespace App\Http\Controllers;

use App\Http\Resources\PilgrimCollection;
use App\Models\City;
use App\Models\District;
use App\Models\Mahalla;
use App\Models\Oblast;
use App\Models\Pilgrim;
use App\Services\PilgrimService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PilgrimController extends Controller
{

    private $pilgrim;
    private $pilgrimService;

    public function __construct(Pilgrim $pilgrim, PilgrimService $pilgrimService)
    {
        $this->pilgrim = $pilgrim;
        $this->pilgrimService = $pilgrimService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pilgrims = $this->pilgrim
            ->with([
                'address',
                'address.oblast:id,name',
                'address.city:id,name',
                'address.district:id,name',
                'address.mahalla:id,name',
            ])
            ->paginate(10);

        $oblasts = Oblast::all();
        $mahallas = Mahalla::all();
        $cities = City::all();
        $districts = District::all();

        return view('pilgrims.index', compact('pilgrims', 'oblasts', 'mahallas', 'cities', 'districts'));
    }

    public function confirmedList(Request $request)
    {
        $pilgrims = $this->pilgrim
            ->with([
                'address',
                'address.oblast:id,name',
                'address.city:id,name',
                'address.district:id,name',
                'address.mahalla:id,name',
            ])
            ->when(($request->type === 'hajj'), function ($query) use ($request) {
                $query->where('hajj_status', 'confirmed');
            })
            ->when(($request->type === 'umra'), function ($query) use ($request) {
                $query->where('umra_status', 'confirmed');
            })
            ->get();

        return view('pilgrims.confirmedList', compact('pilgrims'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pilgrim = $this->pilgrim;

        $this->pilgrimService->fillingPilgrim($pilgrim, $request);

        return redirect()->route('pilgrims.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pilgrim $pilgrim)
    {
        return view('pilgrims.show', compact('pilgrim'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pilgrim $pilgrim)
    {
        return view('pilgrims.edit', compact('pilgrim'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Pilgrim::with('address')->findOrFail($id);
        // Обновление данных пользователя
        $this->pilgrimService->fillingPilgrim($user, $request);

        return redirect()->route('pilgrims.index');
    }

    public function addConfirm(Request $request)
    {
        $pilgrims = $this->pilgrim;

        $pilgrims = $pilgrims
            ->when(($request->type === 'hajj'), function ($query) use ($request) {
                $query->where('hajj_status', 'waiting')
                    ->orderByRaw('last_hajj_date IS NOT NULL')
                    ->orderBy('last_hajj_date', 'asc');
            })
            ->when(($request->type === 'umra'), function ($query) use ($request) {
                $query->where('umra_status', 'waiting')
                    ->orderByRaw('last_umra_date IS NOT NULL')
                    ->orderBy('last_umra_date', 'asc');
            })
            ->limit($request->number)->get();

        foreach ($pilgrims as $pilgrim) {
            if ($request->type === 'hajj') {
                $pilgrim->hajj_status = 'confirmed';
            } elseif ($request->type === 'umra') {
                $pilgrim->umra_status = 'confirmed';
            }

            $pilgrim->save();
        }

        return redirect()->route('pilgrims.confirmedList', ['type' => \request('type')]);
    }

    public function completeConfirms()
    {
        $pilgrims = $this->pilgrim;

        $pilgrims->when((request('type') === 'hajj'), function ($query) {
            $query->where('hajj_status', 'confirmed')
                ->update([
                    'hajj_status' => 'inactive',
                    'last_hajj_date' => Carbon::today()->toDateString(),
                ]);
        })->when((request('type') === 'umra'), function ($query) {
            $query->where('umra_status', 'inactive')
                ->update([
                    'umra_status' => 'inactive',
                    'last_umra_date' => Carbon::today()->toDateString(),
                ]);
        });

        return redirect()->route('pilgrims.confirmedList', ['type' => \request('type')]);
    }

    public function returnWaiting(Request $request)
    {
        if (!$pilgrim = Pilgrim::find($request->id)) {
            return redirect()->route('pilgrims.confirmedList');
        }
        $pilgrim->status = 'waiting';
        $pilgrim->save();

        return redirect()->route('pilgrims.confirmedList', ['type' => \request('type')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$pilgrim = Pilgrim::find($id)) {
            return redirect()->route('pilgrims.index');
        }
        $pilgrim->delete();

        return redirect()->route('pilgrims.index');
    }
}
