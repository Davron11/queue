<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\City;
use App\Models\District;
use App\Models\Mahalla;
use App\Models\Oblast;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $user;
    private $userService;

    public function __construct(User $user, UserService $userService)
    {
        $this->user = $user;
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->user->with([
            'address',
            'address.oblast:id,name',
            'address.city:id,name',
            'address.district:id,name',
            'address.mahalla:id,name',
        ])->paginate(10);

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
        $user = $this->user;

        $this->userService->fillingUser($user, $request);

        return redirect()->route('users.index');
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
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::with('address')->findOrFail($id);
        // Обновление данных пользователя
        $this->userService->fillingUser($user, $request);

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
