<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function showActivate()
    {
        return view('auth.activate');
    }

    public function showSuksesActivate()
    {
        return view('auth.done_activate');
    }

    public function showForgot()
    {
        return view('auth.forgot');
    }

    public function showSuksesForgot()
    {
        return view('auth.done_forgot');
    }

    public function register(Request $request)
    {
        if ($request->ajax()) {
            $messages = [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Email harus berformat email',
                'username.required' => 'Username harus diisi',
                'password_register.required' => 'Kata sandi harus diisi.',
                'password_register.regex' => 'Kata sandi harus berisi minimal 8 Karakter.',
                'password_register.string' => 'Kata sandi harus berupa string.',
            ];

            $rules = [
                'username' => 'required|string|max:50',
                'email' => 'required|email',
                'password_register' => 'required|string|min:8',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()
                ]);
            }

            $user = User::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password_register')),
                'verification_token' => Str::random(60),
            ]);

            Mail::to($user->email)->send(new \App\Mail\VerificationMail($user));

            return response()->json([
                'success' => true,
                'redirect_url' => url('/activate')
            ]);
        }
    }

    function generateRandomSeed($length = 60)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomSeed = '';
        for ($i = 0; $i < $length; $i++) {
            $randomSeed .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomSeed;
    }

    public function login(Request $request)
{
    $messages = [
        'login_identifier.required' => 'Username atau Email harus diisi',
        'login_identifier.exists' => 'Username atau Email tidak ditemukan',
        'password.required' => 'Kata sandi harus diisi',
    ];

    $rules = [
        'login_identifier' => 'required|string',
        'password' => 'required|string|min:6',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return response()->json([
            'error' => true,
            'message' => $validator->errors()
        ]);
    }

    $user = User::where('email', $request->login_identifier)
        ->orWhere('username', $request->login_identifier)
        ->first();

    if (!$user) {
        return response()->json([
            'error' => true,
            'message' => ['login_identifier' => 'Email atau username tidak ditemukan.']
        ], 404);
    }
    if (!Hash::check($request->password, $user->password)) {
        return response()->json([
            'error' => true,
            'message' => ['password' => 'Password yang Anda masukkan salah.']
        ], 401);
    }

    Auth::login($user);
    $token = JWTAuth::fromUser($user);

    session([
        'jwt_token' => $token,
        'paramId' => $user->id,
        'role_id' => $user->role_id,
        'seed' => $this->generateRandomSeed(60)
    ]);

    $redirectUrl = $user->role_id == 1 ? url('/admin/book') : url('/book/beranda');

    return response()->json([
        'error' => false,
        'redirect_url' => $redirectUrl,
        'jwt_token' => $token,
        'paramId' => $user->id,
        'role_id' => session('role_id'),
        'seed' => session('seed')
    ]);
}


    public function activate($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return redirect('/login')->with('error', 'Token verifikasi tidak valid.');
        }

        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->verified = true;
        $user->save();

        return view('auth.done_activate');
    }

    public function showSearchAccountForm()
    {
        return view('auth.search_account');
    }

    public function sendResetPasswordLink(Request $request)
    {
        $messages = [
            'email.email' => 'Email harus berformat email',
            'email.exists' => 'Akun dengan email tersebut tidak ditemukan.',
            'email.required' => 'Email wajib diisi.',
        ];

        $rules = [
            'email' => 'required|email|exists:users,email',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        $user = User::where('email', $request->email)->first();
        $user->forgot_password_token = Str::random(60);
        $user->save();

        Mail::send('emails.forgot_password', ['user' => $user, 'token' => $user->forgot_password_token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Reset Password Anda');
        });

        return response()->json([
            'success' => true,
            'redirect_url' => url('/forgot-password/info')
        ]);
    }

    public function showChangePasswordForm($token)
    {
        $user = User::where('forgot_password_token', $token)->firstOrFail();
        return view('auth.change_password', compact('token'));
    }

    public function resetPassword(Request $request, $token)
    {
        $messages = [
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
            'password.required' => 'Password wajib diisi.',
        ];

        $rules = [
            'password' => 'required|min:8',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        $user = User::where('forgot_password_token', $token)->firstOrFail();
        $user->password = bcrypt($request->password);
        $user->forgot_password_token = null;
        $user->password_change_at = now();
        $user->save();

        return response()->json([
            'success' => true,
            'redirect_url' => url('/reset-password/info')
        ]);
    }

    public function showProfile()
    {
        return view('book.profile');
    }

    public function showUsername()
    {
        $user = Auth::user();
        return view('book.part.username', ['username' => $user->username]);
    }

    public function showEmail()
    {
        return view('book.part.email');
    }

    public function updateProfile(Request $request)
    {
        $messages = [
            'username.required' => 'Username is required',
        ];

        $rules = [
            'username' => 'required|string|max:50',
            'paramId' => 'required|integer',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        $user = User::find($request->paramId);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ]);
        }
        $user->username = $request->username;
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully'
        ]);
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password!']);
        }
        $user->email = $request->email;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Email updated successfully!']);
    }
}
