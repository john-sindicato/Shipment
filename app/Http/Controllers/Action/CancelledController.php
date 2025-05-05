<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;  
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\ApprovedRequest;
use App\Models\CancelledShipment;
use App\Models\Submitted_Request;
use App\Models\Notification;

class CancelledController extends Controller
{
    public function cancelShipments(Request $request)
    {
        $userIds = json_decode($request->input('user_ids'), true); 
        $cancelReason = $request->input('cancel_reason');
    
        if (empty($userIds)) {
            return redirect()->back()->with('error_message', 'No User Selected');
        }
    
        if (empty($cancelReason)) {
            return redirect()->back()->with('error_message', 'Please enter a reason for cancellation.');
        }
    
        $shipments = ApprovedRequest::whereIn('shipment_id', $userIds)->get();
    
        if ($shipments->isEmpty()) {
            return redirect()->back()->with('error_message', 'No matching shipments found.');
        }
    
        try {
            foreach ($shipments as $shipment) { 
                CancelledShipment::create([
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
                    'cancel_reason' => $cancelReason,
                    'cancelled_date' => now()   
                ]);
     
                $existingNotification = Notification::where('email', $shipment->email)
                    ->where('message', "Your shipment number {$shipment->shipment_id} has been cancelled. <br> Reason: {$cancelReason}")
                    ->exists();
    
                if (!$existingNotification) {
                    Notification::create([
                        'email' => $shipment->email,
                        'message' => "Your shipment number {$shipment->shipment_id} has been cancelled. <br> Reason: {$cancelReason}"
                    ]);
                }
     
                $shipment->delete();
            }
    
            return redirect()->route('teller.pages.approved')
                             ->with('success', 'Shipment Cancelled.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'An error occurred while processing the shipments.');
        }
    }




    public function cancelShipments_user(Request $request)
    {
        $userIds = json_decode($request->input('user_ids'), true);
        $cancelReason = $request->input('cancel_reason');
        
        if (empty($userIds)) {
            return redirect()->back()->with('error_message', 'No User Selected');
        }
    
        if (empty($cancelReason)) {
            return redirect()->back()->with('error_message', 'Please enter a reason for cancellation.');
        }
    
        $submittedShipments = Submitted_Request::whereIn('shipment_id', $userIds)->get();
    
        $requestShipments = DB::table('request')->whereIn('shipment_id', $userIds)->get();
    
        if ($submittedShipments->isEmpty() && $requestShipments->isEmpty()) {
            return redirect()->back()->with('error_message', 'No matching shipments found.');
        }
    
        try {
            foreach ($submittedShipments as $shipment) {
                $matchingRequest = $requestShipments->firstWhere('shipment_id', $shipment->shipment_id);
    
                CancelledShipment::create([
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
                    'cancel_reason' => $cancelReason,
                    'cancelled_date' => now(),
                ]);
    
                $shipment->delete();
            }
    
            foreach ($requestShipments as $shipment) {
                CancelledShipment::create([
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
                    'cancel_reason' => $cancelReason,
                    'cancelled_date' => now(),
                ]);

                DB::table('request')->where('shipment_id', $shipment->shipment_id)->delete();
            }
     
            return redirect()->route('customer.pages.shipment.pending')
                             ->with('success', 'Shipment Cancelled.');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'An error occurred while processing the shipments.');
        }
    }
    
    

    public function index()
    {
        $shipments = DB::table('cancelled_shipment')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'cancel_reason', 'cancelled_date')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'cancel_reason', 'cancelled_date')
        ->orderByDesc('id', 'desc')
        ->paginate(20);   

        return view('admin.pages.shipments.cancelled', compact('shipments'));
    }

    public function show($id)
    {
        $shipment = CancelledShipment::where('shipment_id', $id)->get();
        return view('admin.pages.shipments.details.cancelled', compact('shipment'));
    }
    

    public function index_user()
    { 
        $userEmail = auth()->user()->email;
     
        $shipments = DB::table('cancelled_shipment')
            ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                     'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'cancel_reason', 'cancelled_date')
            ->where('email', $userEmail)   
            ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                     'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination','cancel_reason', 'cancelled_date')
            ->orderByDesc('id', 'desc')
            ->paginate(20);
    
        return view('customer.pages.shipment.cancelled', compact('shipments'));
    }
    
    public function show_user($id)
    {
        $shipment = CancelledShipment::where('shipment_id', $id)->get();
        return view('customer.pages.shipment.details.cancelled', compact('shipment'));
    }
}
