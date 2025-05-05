<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLogoutController extends Controller
{
    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->forget('admin_email');  
        return redirect()->route('admin.login');
    }
}
