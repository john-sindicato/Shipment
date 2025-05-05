<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;  
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Queued;
use App\Models\ApprovedRequest;
use App\Models\Notification;

class QueuedController extends Controller
{
    public function dispatchShipment(HttpRequest $request)  
    {
        $userIds = json_decode($request->input('user_ids'), true); 
    
        if (empty($userIds)) {
            return redirect()->back()->with('error_message', 'No User Selected');
        }
    
        $shipments = ApprovedRequest::whereIn('shipment_id', $userIds)->get();
    
        if ($shipments->isEmpty()) {
            return redirect()->back()->with('error_message', 'No matching shipments found.');
        }
    
        try {
            foreach ($shipments as $shipment) { 
                Queued::create($shipment->toArray());

                $existingNotification = Notification::where('email', $shipment->email)
                ->where('message', "Your shipment number {$shipment->shipment_id} is now Ready for Dispatch.")
                ->exists();

            if (!$existingNotification) {
                Notification::create([
                    'email' => $shipment->email,
                    'message' => "Your shipment number {$shipment->shipment_id} is now Ready for Dispatch."
                ]);
            }

                $shipment->delete();
            }
    
            return redirect()->route('teller.pages.approved')
            ->with('success', 'Shipment is Ready for Dispatch.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'An error occurred while processing the shipments.');
        }
    }


  
    public function updateDispatchDate(Request $request)
    {
        $request->validate([
            'user_ids' => 'required',
            'dispatch_date' => 'required|date'
        ]);

        $userIds = json_decode($request->user_ids, true);

        if (!is_array($userIds)) {
            return redirect()->back()->with('error', 'Invalid shipment selection.');
        }

        $shipments = Queued::whereIn('shipment_id', $userIds)->get();

        if ($shipments->isEmpty()) {
            return redirect()->back()->with('error', 'No matching shipments found.');
        }

        $formattedDate = Carbon::parse($request->dispatch_date)->format('F j, Y');

        DB::table('queued')
            ->whereIn('shipment_id', $userIds)
            ->update(['dispatch_date' => $request->dispatch_date]);

        foreach ($shipments as $shipment) {
            $message = "Your shipment number {$shipment->shipment_id} has been rescheduled to {$formattedDate} due to unforeseen circumstances.";

            $existingNotification = Notification::where('email', $shipment->email)
                ->where('message', $message)
                ->exists();

            if (!$existingNotification) {
                Notification::create([
                    'email' => $shipment->email,
                    'message' => $message
                ]);
            }
        }

        return redirect()->back()->with('success', 'Dispatch date updated successfully.');
    }
    
    
    public function index()
    {
        $shipments = DB::table('queued')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date')
        ->orderByDesc('id', 'desc')
        ->paginate(20);

        return view('teller.pages.queued', compact('shipments'));
    }

    public function show($id)
    {
        $shipment = Queued::where('shipment_id', $id)->get();
        return view('teller.pages.details.queued', compact('shipment'));
    }

    public function index_admin()
    {
        $shipments = DB::table('queued')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date')
        ->orderByDesc('id', 'desc')
        ->paginate(20);

        return view('admin.pages.shipments.queued', compact('shipments'));
    }

    public function show_admin($id)
    {
        $shipment = Queued::where('shipment_id', $id)->get();
        return view('admin.pages.shipments.details.queued', compact('shipment'));
    }



    public function index_user()
    { 
        $userEmail = auth()->user()->email;
     
        $shipments = DB::table('queued')
            ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                     'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date')
            ->where('email', $userEmail)   
            ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                     'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date')
            ->orderByDesc('id', 'desc')
            ->paginate(20);
    
        return view('customer.pages.shipment.queued', compact('shipments'));
    }
    
    public function show_user($id)
    {
        $shipment = Queued::where('shipment_id', $id)->get();
        return view('customer.pages.shipment.details.queued', compact('shipment'));
    }
}
