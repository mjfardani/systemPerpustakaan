<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function register_admin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(10),
            'role' => 'ADMIN',
            'plain_token' => '',
        ]);
        return response()->json(['message' => 'Berhasil'], 200);
    }

    public function register_siswa(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
        ]);
        $id = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
            'role' => 'SISWA',
            'plain_token' => '',
        ]);
        $user = User::find($id);
        $plain_token = $user->createToken('machine-to-machine-token')
            ->plainTextToken;
        $user->plain_token = $plain_token;
        $user->save();
        return response()->json([
            'token' => $plain_token,
            'message' => 'Berhasil'
        ], 200);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to find the user by email
        $user = User::where('email', $request->email)->first();

        // Verify if user exists and password is correct
        if (
            !$user ||
            !Hash::check($request->password, $user->password)
        ) {
            return response()->json([
                'message' => 'Invalid login credentials'
            ], 401);
        }

        // Create a new Sanctum token for the user
        $token = $user->createToken('API Token')->plainTextToken;

        // Return response with role-specific message
        return response()->json([
            'token' => $token,
            'role' => $user->role, // Info role user
            'message' => 'Login successful'
        ]);
    }



    public function logout(Request $request)
    {
        // Menghapus token akses saat ini untuk pengguna yang sedang login
        $request->user()->currentAccessToken()->delete();

        // Mengembalikan respon bahwa logout berhasil
        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
