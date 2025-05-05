<?php

namespace App\Http\Controllers\Teller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Teller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TellerLoginController extends Controller
{
    public function login_teller(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
        ]);
    
        $teller = Teller::where('email', $request->email)->first();
    
        if (!$teller) {
            return back()->withErrors(['email' => 'This email is not registered.'])->withInput();
        }
    
        if ($teller->status === 'deleted') { 
            return back()->withErrors(['email' => 'Your account has been deleted.'])->withInput();
        }
    
        if (!\Hash::check($request->password, $teller->password)) {
            return back()->withErrors(['password' => 'Incorrect password'])->withInput();
        }
    
        Auth::login($teller);
        session([
            'teller_email'    => $teller->email,
            'teller_fname'    => $teller->fname,
            'teller_lname'    => $teller->lname,
            'teller_dob'      => $teller->dob,
            'teller_gender'   => $teller->gender,
            'teller_phone'    => $teller->phone,
            'teller_street'   => $teller->street,
            'teller_brgy'     => $teller->brgy,
            'teller_city'     => $teller->city,
            'teller_province' => $teller->province,
            'teller_zipcode'  => $teller->zipcode,
            'teller_branch'   => $teller->branch,
            'teller_profile'  => $teller->profile 
        ]);
    
        return redirect()->route('teller.pages.dashboard');
    }    
}
