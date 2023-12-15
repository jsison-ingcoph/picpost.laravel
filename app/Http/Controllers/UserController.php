<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $user =  User::where('username', $request->username)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'msg' => 'Invalid credentials.',
            ], 401);
        }
        $token = $user->createToken('auth_token')->accessToken;
        return response()->json([
            'msg' => 'Login successfully.',
            'token' => $token,
        ], 200);
    }

    public function register(Request $request)
    {
        try {
            $existingUser = User::where('username', $request->username)->first();
            if ($existingUser) {
                return response()->json([
                    'msg' => 'Username already taken.',
                ], 409);
            }
            $validated = $request->validate([
                'username' => 'required|string|unique:users',
                'password' => 'required|string',
                'lastname' => 'required|string',
                'firstname' => 'required|string',
                'middlename' => 'nullable|string',
                'suffix' => 'nullable|string',
                'gender' => 'required|in:male,female',
                'birthdate' => 'required|date',
            ]);
            $validated['password'] = Hash::make($validated['password']);
            $user = User::create($validated);
            return response()->json([
                'msg' => 'Registered successfully.',
                'user' => $user,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Internal server error.',
                'err' => $th,
            ], 500);
        }
    }
}
