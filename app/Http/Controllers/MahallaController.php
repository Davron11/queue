<?php

namespace App\Http\Controllers;

use App\Models\Mahalla;
use Illuminate\Http\Request;

class MahallaController extends Controller
{
    private $mahalla;

    public function __construct(Mahalla $mahalla)
    {
        $this->mahalla = $mahalla;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahallas = $this->mahalla;
        $mahallas = $mahallas->paginate();

        return view('mahallas.index', compact('mahallas'));
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
        $mahalla = $this->mahalla->find($id);

        $mahalla->update($request->all());

        return redirect()->route('mahallas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($mahalla = Mahalla::find($id)) {
            $mahalla->delete();
        }

        return redirect()->route('mahallas.index');
    }
}
