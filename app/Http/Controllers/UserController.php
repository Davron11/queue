<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
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
    public function update(UpdateUserRequest $request, string $id)
    {
        // Поиск пользователя по ID
        $user = User::findOrFail($id);

        // Валидация данных
        $validated = $request->validated();

        // Обновление данных пользователя
        $user->update([
            'full_name' => $validated['full_name'],
            'pinfl' => $validated['pinfl'],
            'phone_number' => $validated['phone_number'],
            'role_id' => $validated['role_id'],
            'passport_series' => $validated['passport_series'] ?? null,
            'passport_number' => $validated['passport_number'] ?? null,
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
        ]);

        if (isset($validated['address'])) {
            $user->address()->updateOrCreate(
                ['user_id' => $user->id],
                $validated['address']
            );
        }

        return redirect()->route('users.index')->with('success', 'Пользователь успешно обновлен.');
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
