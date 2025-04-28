<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Mahalla;
use App\Models\Oblast;
use App\Models\Pilgrim;
use App\Services\PilgrimService;
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
            ->where('status', 'confirmed')
            ->get();

        return view('pilgrims.confirmedList', compact('pilgrims'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        logger('create');
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
    {logger($request->all());
        $pilgrims = $this->pilgrim;

        $pilgrims = $pilgrims->where('status', 'waiting')
            ->orderByRaw('last_pilgrimage_date IS NOT NULL')
            ->orderBy('last_pilgrimage_date', 'asc')
            ->limit($request->number)->get();

        foreach ($pilgrims as $pilgrim) {
            $pilgrim->status = 'confirmed';
            $pilgrim->save();
        }

        return redirect()->route('pilgrims.confirmedList');
    }

    public function completeConfirms()
    {
        $pilgrims = $this->pilgrim;

        $pilgrims->where('status', 'confirmed')->update(['status' => 'inactive']);

        return redirect()->route('pilgrims.confirmedList');
    }

    public function returnWaiting(Request $request)
    {
        if (!$pilgrim = Pilgrim::find($request->id)) {
            return redirect()->route('pilgrims.confirmedList');
        }
        $pilgrim->status = 'waiting';
        $pilgrim->save();

        return redirect()->route('pilgrims.confirmedList');
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
