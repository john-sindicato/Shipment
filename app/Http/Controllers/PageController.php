<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rates;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('customer.auth.login');
    }

    public function showRatesindex()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        
        $company = Company::first();
        
        $branches = Branch::where('status', '!=', 'deleted')
                          ->orderBy('province', 'asc')
                          ->get();
        
        $rates = Rates::where('status', '!=', 'deleted')
                      ->orderBy('origin', 'asc')
                      ->get();
        
        return view('customer.index', compact('company', 'branches', 'rates'));
    }
    
    public function sign_up()
    {   
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('customer.auth.sign_up');
    }

    public function layout()
    {
        return view('customer.layout.layout');   
    }

    public function request_form(){
        return view('customer.pages.request_form');
    }

    public function home()
    {
        return view('customer.pages.home');
    }

    public function shipmentDashboard(){
        return view('customer.pages.shipment_dashboard');
    }

    //Shipments
    public function pending(){
        return view('customer.pages.shipment.pending');
    }

    public function approved(){
        return view('customer.pages.shipment.approved');
    }

    public function queued(){
        return view('customer.pages.shipment.queued');
    }

    public function in_transit(){
        return view('customer.pages.shipment.in_transit');
    }

    public function dispatched(){
        return view('customer.pages.shipment.dispatched');
    }

    public function cancelled(){
        return view('customer.pages.shipment.cancelled');
    }

    public function claimed(){
        return view('customer.pages.shipment.claimed');
    }
    public function unclaim(){
        return view('customer.pages.shipment.unclaim');
    }
}
