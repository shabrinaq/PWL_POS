<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) { // jika sudah login, maka redirect ke halaman home
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')

                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }
        return redirect('login');
    }

    /**
     * Menampilkan halaman register
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi user
     */
    public function postregister(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|min:3|max:20|unique:m_user,username',
                'nama'     => 'required|string|max:100',
                'password' => 'required|min:5|max:20',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi gagal',
                    'msgField' => $validator->errors(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            // Simpan user baru
            UserModel::create([
                'username' => $request->username,
                'nama'     => $request->nama,
                'password' => Hash::make($request->password),
                'level_id' => 3, // Default level user
            ]);

            return response()->json([
                'status'   => true,
                'message'  => 'Registrasi berhasil! Silakan login.',
                'redirect' => url('login'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Terjadi kesalahan di server: ' . $e->getMessage(),
            ], 500);
        }
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();
        return redirect('login');
    }
}