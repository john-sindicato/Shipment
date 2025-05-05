<?php


namespace App\Http\Controllers\Teller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TellerLogoutController extends Controller
{
    public function logout(Request $request)
    {
        $request->session()->forget(['teller_email', 'teller_fname', 'teller_lname']);
        $request->session()->flush();   

        return redirect()->route('teller.login');
    }
}