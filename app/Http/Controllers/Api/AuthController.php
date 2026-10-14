<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // POST /api/auth/register
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'username'   => 'nullable|string|max:50|unique:users,username',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:6',
            'birth_date' => 'nullable|date',
            'gender'     => 'nullable|in:pria,wanita,netral',
            'genres'     => 'nullable|array',
            'genres.*'   => 'integer|exists:genres,id',
        ]);

        // password otomatis di-hash oleh cast 'hashed' di model User
        $user = User::create([
            'name'       => $data['name'],
            'username'   => $data['username'] ?? null,
            'email'      => $data['email'],
            'password'   => $data['password'],
            'birth_date' => $data['birth_date'] ?? null,
            'gender'     => $data['gender'] ?? null,
        ]);

        if (!empty($data['genres'])) {
            $user->genres()->sync($data['genres']);
        }
        $user->readingLists()->createMany([
            ['name' => 'Perpustakaan', 'is_private' => true],
            ['name' => 'Daftar Bacaan Saya', 'is_private' => false],
        ]);
        
        return response()->json([
            'token' => $user->createToken('mobile')->plainTextToken,
            'user'  => $user->load('genres:id,name'),
        ], 201);
    }

    // POST /api/auth/login
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Email atau password salah'], 422);
        }

        return response()->json([
            'token' => $user->createToken('mobile')->plainTextToken,
            'user'  => $user->load('genres:id,name'),
        ]);
    }

    // GET /api/me
    public function me(Request $request)
    {
        return response()->json(['data' => $request->user()->load('genres:id,name')]);
    }

    // POST /api/auth/logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Berhasil keluar']);
    }
}