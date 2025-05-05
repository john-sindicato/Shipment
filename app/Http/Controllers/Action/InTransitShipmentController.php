<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;  
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
use App\Models\Queued;
use App\Models\InTransitShipment;
use App\Models\Notification;
use App\Models\Rates;
use App\Models\ClaimStub;

class InTransitShipmentController extends Controller
{
    public function startTransit(HttpRequest $request)
    {
        $userIds = $request->input('user_ids');
        
        if (empty($userIds)) {
            return redirect()->back()->with('error_message', 'No User Selected');
        }
    
        $shipments = Queued::whereIn('shipment_id', $userIds)->get();
    
        if ($shipments->isEmpty()) {
            return redirect()->back()->with('error_message', 'No matching shipments found.');
        }
    
        try {
            foreach ($shipments as $shipment) {
                $shippingRate = Rates::where(function ($query) use ($shipment) {
                    $query->where('origin', $shipment->origin)
                          ->where('destination', $shipment->destination);
                })->orWhere(function ($query) use ($shipment) {
                    $query->where('origin', $shipment->destination)
                          ->where('destination', $shipment->origin);
                })->first();
                
                if (!$shippingRate) {
                    return redirect()->back()->with('error_message', 'Shipping rate not found for the selected route.');
                }
                
                $deliveryDays = (int)$shippingRate->delivery_days;
    
                $startDate = Carbon::parse($shipment->dispatch_date)->addDays($deliveryDays)->format('Y-m-d');
                $endDate = Carbon::parse($shipment->dispatch_date)->addDays($deliveryDays + 3)->format('Y-m-d');
                $expectedDeliveryDate = "{$startDate} - {$endDate}";
    
                InTransitShipment::create(
                    array_merge(
                        $shipment->toArray(), 
                        ['expected_delivery_date' => $expectedDeliveryDate]
                    )
                );
    
                ClaimStub::firstOrCreate(
                    ['shipment_id' => $shipment->shipment_id],
                    [
                        'fname' => $shipment->fname,
                        'lname' => $shipment->lname,
                        'phone' => $shipment->phone,
                        'email' => $shipment->email,
                        'expected_delivery_date' => $expectedDeliveryDate,
                    ]
                );
    
                $existingNotification = Notification::where('email', $shipment->email)
                    ->where('message', "Your shipment number {$shipment->shipment_id} is now In Transit.")
                    ->exists();
    
                if (!$existingNotification) {
                    Notification::create([
                        'email' => $shipment->email,
                        'message' => "Your shipment number {$shipment->shipment_id} is now In Transit."
                    ]);
                }
    
                $shipment->delete();  
            }
    
            return redirect()->route('teller.pages.queued')->with('success', 'Shipment In Transit.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'An error occurred while sending shipments.');
        }
    }

    
    public function index()
    {
        $shipments = DB::table('in_transit_shipment')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'expected_delivery_date')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'expected_delivery_date')
        ->orderByDesc('id', 'desc')
        ->paginate(20);

        return view('teller.pages.in_transit', compact('shipments'));
    }

    public function show($id)
    {
        $shipment = InTransitShipment::where('shipment_id', $id)->get();
        return view('teller.pages.details.in_transit', compact('shipment'));
    }

    public function index_admin()
    {
        $shipments = DB::table('in_transit_shipment')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'expected_delivery_date')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'expected_delivery_date')
        ->orderByDesc('id', 'desc')
        ->paginate(20); 

        return view('admin.pages.shipments.in_transit', compact('shipments'));
    }

    public function show_admin($id)
    {
        $shipment = InTransitShipment::where('shipment_id', $id)->get();
        return view('admin.pages.shipments.details.in_transit', compact('shipment'));
    }

    public function index_user()
    { 
        $userEmail = auth()->user()->email;
     
        $shipments = DB::table('in_transit_shipment')
            ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                     'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'expected_delivery_date')
            ->where('email', $userEmail)   
            ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                     'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'expected_delivery_date')
            ->orderByDesc('id', 'desc')
            ->paginate(20);
    
        return view('customer.pages.shipment.in_transit', compact('shipments'));
    }
    
    public function show_user($id)
    {
        $shipment = InTransitShipment::where('shipment_id', $id)->get();
        return view('customer.pages.shipment.details.in_transit', compact('shipment'));
    }

    public function in_transit_badge()
    {  
        $userEmail = Auth::user()->email;
        $inTransitCount = InTransitShipment::where('email', $userEmail)->count();
        return view('customer.pages.shipment_dashboard', compact('inTransitCount'));
    }

}
