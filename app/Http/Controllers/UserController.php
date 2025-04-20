<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Mahalla;
use App\Models\Oblast;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->user->paginate(10);

        $roles = Role::all();

        $oblasts = Oblast::all();
        $mahallas = Mahalla::all();
        $cities = City::all();
        $districts = District::all();

        return view('users.index', compact('users', 'roles', 'oblasts', 'mahallas', 'cities', 'districts'));
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
        if (!$user = User::find($id)) {
            return redirect()->route('users.index');
        }

//        $user->update([
//            'full_name' => $request->get('full_name'),
//            'email' => $request->get('email'),
//            'phone_number' => $request->get('phone_number'),
//            'role_id' => $request->get('role_id'),
//            'passport_data' => $request->get('passport_data'),
//
//        ]);
        logger($request->all());

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$user = User::find($id)) {
            return redirect()->route('users.index');
        }

        $user->delete();
        return redirect()->route('users.index');
    }
}
