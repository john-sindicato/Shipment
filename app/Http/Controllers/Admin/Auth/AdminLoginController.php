<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth; 

class AdminLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return back()->withErrors(['email' => 'This email is not registered as an admin'])->withInput();
        }

        if ($admin->password !== $request->password) {
            return back()->withErrors(['password' => 'Incorrect password'])->withInput();
        }


        Auth::guard('admin')->login($admin);
        session(['admin_email' => $admin->email]); 

        return redirect()->route('admin.pages.dashboard');
    }
}
