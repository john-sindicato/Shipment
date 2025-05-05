<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;  
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Submitted_Request;
use App\Models\ApprovedRequest;
use App\Models\Notification;

class Approved_RequestController extends Controller
{
    public function approveShipments(Request $request)
    {
        $userIds = json_decode($request->input('user_ids'), true); 
        $dispatchDate = $request->input('dispatch_date');
    
        if (empty($userIds)) {
            return redirect()->back()->with('error_message', 'No User Selected');
        }
    
        if (empty($dispatchDate)) {
            return redirect()->back()->with('error_message', 'Please enter a dispatch date.');
        }
    
        $shipments = Submitted_Request::whereIn('shipment_id', $userIds)->get();
    
        if ($shipments->isEmpty()) {
            return redirect()->back()->with('error_message', 'No matching shipments found.');
        }
    
        try {
            foreach ($shipments as $shipment) {
                ApprovedRequest::create([
                    'shipment_id' => $shipment->shipment_id,
                    'fname' => $shipment->fname,
                    'lname' => $shipment->lname,
                    'phone' => $shipment->phone,
                    'email' => $shipment->email,
                    'street' => $shipment->street,
                    'brgy' => $shipment->brgy,
                    'city' => $shipment->city,
                    'province' => $shipment->province,
                    'zipcode' => $shipment->zipcode,
                    'region' => $shipment->region,
                    'origin' => $shipment->origin,
                    'destination' => $shipment->destination,
                    'category' => $shipment->category,
                    'length' => $shipment->length,
                    'width' => $shipment->width,
                    'height' => $shipment->height,
                    'weight' => $shipment->weight,
                    'dispatch_date' => $dispatchDate
                ]);
    
                $existingNotification = Notification::where('email', $shipment->email)
                ->where('message', "Your shipment number {$shipment->shipment_id} is successfully approved. You may now deliver your item to the nearest Navi Cargo branch in your area.")
                ->exists();

            if (!$existingNotification) {
                Notification::create([
                'email' => $shipment->email,
                'message' => "Your shipment number {$shipment->shipment_id} is successfully approved. You may now deliver your item to the nearest Navi Cargo branch in your area."
                ]);
            }
    
                $shipment->delete();
            }
    
            return redirect()->route('admin.pages.shipments.submitted_request')
                             ->with('success', 'Shipment successfully approved.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'An error occurred while processing the shipments.');
        }
    }
    

    public function index()
    {
        $shipments = DB::table('approved_request')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date')
        ->orderByDesc('id', 'desc')
        ->paginate(20);

        return view('teller.pages.approved', compact('shipments'));
    }

    public function show($id)
    {
        $shipment = ApprovedRequest::where('shipment_id', $id)->get();
        return view('teller.pages.details.approved', compact('shipment'));
    }



    public function index_user()
    { 
        $userEmail = auth()->user()->email;
     
        $shipments = DB::table('approved_request')
            ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                     'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date')
            ->where('email', $userEmail)   
            ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                     'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date')
            ->orderByDesc('id', 'desc')
            ->paginate(20);
    
        return view('customer.pages.shipment.approved', compact('shipments'));
    }
    
    public function show_user($id)
    {
        $shipment = ApprovedRequest::where('shipment_id', $id)->get();
        return view('customer.pages.shipment.details.approved', compact('shipment'));
    }
}
