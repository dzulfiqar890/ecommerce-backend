<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
{
    $data = $request->validate([
        'nama'      => 'required|string|max:100',
        'email'     => 'required|email|unique:pengguna,email',
        'password'  => 'required|string|min:6|confirmed',
        'no_telepon'=> 'nullable|string',
        'alamat'    => 'nullable|string',
        // Validasi role jika disediakan; jika tidak, default ke 'customer'
        'role'      => 'nullable|in:customer,admin'
    ]);

    // Gunakan role dari request jika ada, jika tidak, default ke 'customer'
    $role = $data['role'] ?? 'customer';

    // Hanya izinkan pendaftaran admin jika ada mekanisme otorisasi tambahan
    // Contoh: cek apakah user yang mendaftar memiliki token khusus
    // atau proses pendaftaran admin dilakukan melalui endpoint berbeda.

    $user = User::create([
        'nama'      => $data['nama'],
        'email'     => $data['email'],
        'password'  => Hash::make($data['password']),
        'no_telepon'=> $data['no_telepon'] ?? null,
        'alamat'    => $data['alamat'] ?? null,
        'role'      => $role
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message'       => 'User registered successfully',
        'access_token'  => $token,
        'token_type'    => 'Bearer'
    ]);
}


    // Login
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'       => 'User logged in successfully',
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
