<?php

namespace App\Http\Controllers;

use App\Models\Oblast;
use App\Models\Pilgrim;
use Illuminate\Http\Request;

class StateController extends Controller
{
    private $oblast;

    public function __construct(Oblast $oblast)
    {
        $this->oblast = $oblast;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = $this->oblast;
        $states = $states->paginate();

        return view('states.index', compact('states'));
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
        $state = $this->oblast->find($id);logger($request->all());

        $state->update($request->all());

        return redirect()->route('states.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($state = Oblast::find($id)) {logger($state);
            $state->delete();
        }

        return redirect()->route('states.index');
    }
}
