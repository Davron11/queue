<?php

namespace App\Http\Controllers;

use App\Models\Pilgrim;
use Illuminate\Http\Request;

class PilgrimController extends Controller
{

    private $pilgrim;

    public function __construct(Pilgrim $pilgrim)
    {
        $this->pilgrim = $pilgrim;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pilgrims = $this->pilgrim
            ->with([
                'details',
                'details.oblast:id,name',
                'details.city:id,name',
                'details.district:id,name',
                'details.mahalla:id,name',
            ])
            ->paginate(10);

        return view('pilgrims.index', compact('pilgrims'));
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
        logger('store');
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
        $pilgrim = $this->pilgrim->find($request->pilgrim_id);

        $pilgrim->update([
            'full_name' => $request->full_name,
            'pinfl' => $request->pinfl,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('pilgrims.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$pilgrim = Pilgrim::find($id)) {logger('destroy');
            return redirect()->route('pilgrims.index');
        }
        $pilgrim->delete();

        return redirect()->route('pilgrims.index');
    }
}
