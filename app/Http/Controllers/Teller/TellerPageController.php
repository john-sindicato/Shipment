<?php

namespace App\Http\Controllers\Teller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class TellerPageController extends Controller
{
    public function login() {
        if (session()->has('teller_email')) {
            return redirect()->route('teller.pages.request');
        }
        return view('teller.login');
    }

    public function dashboard(){
        return view('teller.pages.dashboard');
    }

    public function request(){
        return view('teller.pages.request');
    }

    public function change_Password(){
        return view('teller.pages.change_password');
    }

    public function profile(){
        return view('teller.pages.profile');
    }

    public function declined(){
        return view('teller.pages.declined');
    }

    public function approved(){
        return view('teller.pages.approved');
    }

    public function queued(){
        return view('teller.pages.queued');
    }

    public function inTransit(){
        return view('teller.pages.in_transit');
    }

    public function dispatched(){
        return view('teller.pages.dispatched');
    }
    public function claimed(){
        return view('teller.pages.claimed');
    }
    public function unclaimed(){
        return view('teller.pages.unclaimed');
    }
}
