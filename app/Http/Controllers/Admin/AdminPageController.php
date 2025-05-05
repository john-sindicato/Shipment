<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth; 

class AdminPageController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.pages.dashboard'); 
        }
        return view('admin/login');
    }

    public function dashboard(){
        return view('admin.pages.dashboard');
    }
 

    public function layout(){
        return view('admin/layout/layout');
    }

    public function branch(){
        return view('admin/pages/company/branch');
    }

    public function rates(){
        return view('admin.pages.rates.rates');
    }

    public function user(){
        return view('admin.pages.accounts.user');
    }

    public function categories(){
        return view('admin.pages.rates.categories');
    }

    public function company(){
        return view('admin.pages.company.contact_details');
    }

    public function teller(){
        return view('admin.pages.accounts.teller');
    }


    public function submitted_request(){
        return view('admin.pages.shipments.submitted_request');
    }

    public function queued(){
        return view('admin.pages.shipments.queued');
    }

    public function cancelled(){
        return view('admin.pages.shipments.cancelled');
    }

    public function dispatched(){
        return view('admin.pages.shipments.dispatched');
    }

    public function claimed(){
        return view('admin.pages.shipments.claimed');
    }

    public function unclaim(){
        return view('admin.pages.shipments.unclaim');
    }
}    