<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;  
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; 
use App\Models\InTransitShipment;
use App\Models\DispatchedShipment;
use App\Models\Notification;

class DispatchController extends Controller
{
    public function shipmentDispatched(HttpRequest $request)  
    {
        $userIds = $request->input('user_ids');
    
        if (empty($userIds)) {
            return redirect()->back()->with('error_message', 'No User Selected');
        }
    
        $shipments = InTransitShipment::whereIn('shipment_id', $userIds)->get();
    
        if ($shipments->isEmpty()) {
            return redirect()->back()->with('error_message', 'No matching shipments found.');
        }
    
        try {
            foreach ($shipments as $shipment) {
                DispatchedShipment::create($shipment->toArray());

                $existingNotification = Notification::where('email', $shipment->email)
                    ->where('message', "Your shipment number {$shipment->shipment_id} successfully arrived at the destination.")
                    ->exists();
    
                if (!$existingNotification) {
                    Notification::create([
                        'email' => $shipment->email,
                        'message' => "Your shipment number {$shipment->shipment_id} successfully arrived at the destination."
                    ]);
                }
    
              $shipment->delete();
            }
    
            return redirect()->route('teller.pages.in_transit')->with('success', 'Shipment Dispatched.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'An error occurred while sending shipments.');
        }
    }




    
    
    public function index()
    {
        $shipments = DB::table('dispatched_shipment')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date')
        ->orderByDesc('id', 'desc')
        ->paginate(20);

        return view('teller.pages.dispatched', compact('shipments'));
    }

    public function show($id)
    {
        $shipment = DispatchedShipment::where('shipment_id', $id)->get();
        return view('teller.pages.details.dispatched', compact('shipment'));
    }

    public function index_admin()
    {
        $shipments = DB::table('dispatched_shipment')
            ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                    'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 
                    'destination', 'dispatch_date', 'arrival_date')
            ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                    'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 
                    'destination', 'dispatch_date', 'arrival_date')
            ->orderByDesc('id')
            ->paginate(20);   
    
        return view('admin.pages.shipments.dispatched', compact('shipments'));
    }
    

    public function show_admin($id)
    {
        $shipment = DispatchedShipment::where('shipment_id', $id)->get();
        return view('admin.pages.shipments.details.dispatched', compact('shipment'));
    }



    public function index_user()
    { 
        $userEmail = auth()->user()->email;
     
        $shipments = DB::table('dispatched_shipment')
            ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                     'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date')
            ->where('email', $userEmail)   
            ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                     'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date')
            ->orderByDesc('id', 'desc')
            ->paginate(20);
    
        return view('customer.pages.shipment.dispatched', compact('shipments'));
    }
    
    public function show_user($id)
    {
        $shipment = DispatchedShipment::where('shipment_id', $id)->get();
        return view('customer.pages.shipment.details.dispatched', compact('shipment'));
    }

}
