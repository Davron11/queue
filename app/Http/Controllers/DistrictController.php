<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    private $district;

    public function __construct(District $district)
    {
        $this->district = $district;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = $this->district;
        $districts = $districts->paginate();

        return view('districts.index', compact('districts'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $district = $this->district->find($id);

        $district->update($request->all());

        return redirect()->route('districts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($state = District::find($id)) {
            $state->delete();
        }

        return redirect()->route('districts.index');
    }
}
