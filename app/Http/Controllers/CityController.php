<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = $this->city;
        $cities = $cities->paginate();

        return view('cities.index', compact('cities'));
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
        $city = $this->city->find($id);

        $city->update($request->all());

        return redirect()->route('cities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($city = City::find($id)) {
            $city->delete();
        }

        return redirect()->route('cities.index');
    }
}
