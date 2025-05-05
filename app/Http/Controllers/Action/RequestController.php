<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Request;   
use App\Models\ApprovedRequest;
use App\Models\Queued;
use App\Models\InTransitShipment;
use App\Models\DispatchedShipment;
use App\Models\CancelledShipment;
use App\Models\Submitted_Request;
use Illuminate\Support\Facades\DB;
use App\Models\ClaimedShipment;
use App\Models\UnclaimShipment;

class RequestController extends Controller
{
    private function generateRandomID() {
        $digits = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $letters = Str::upper(Str::random(2));
        return $digits . $letters;
    }

    public function store_request(HttpRequest $request) {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'street' => 'required|string|max:255',
            'brgy' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'zipcode' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'category' => 'required|array',
            'category.*' => 'required|string|max:255',
            'length' => 'required|array',
            'length.*' => 'required|numeric|min:0',
            'width' => 'required|array',
            'width.*' => 'required|numeric|min:0',
            'height' => 'required|array',
            'height.*' => 'required|numeric|min:0',
            'weight' => 'required|array',
            'weight.*' => 'required|numeric|min:0',
        ]);

        $shipment_id = $this->generateRandomID();

        foreach ($validated['category'] as $index => $category) {
            Request::create([
                'shipment_id' => $shipment_id,
                'fname' => $validated['fname'],
                'lname' => $validated['lname'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'street' => $validated['street'],
                'brgy' => $validated['brgy'],
                'city' => $validated['city'],
                'province' => $validated['province'],
                'zipcode' => $validated['zipcode'],
                'region' => $validated['region'],
                'origin' => $validated['origin'],
                'destination' => $validated['destination'],
                'category' => $category,
                'length' => $validated['length'][$index] ?? '',
                'width' => $validated['width'][$index] ?? '',
                'height' => $validated['height'][$index] ?? '',
                'weight' => $validated['weight'][$index] ?? '',
            ]);
        }

        return redirect()->route('routes')->with('success', 'Request submitted successfully!');
    }


    public function index()
    {
        $shipments = DB::table('request')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination')
        ->orderByDesc('id', 'desc')
        ->paginate(20);

        return view('teller.pages.request', compact('shipments'));
    }

    public function show($id)
    {
        $shipment = Request::where('shipment_id', $id)->get();
        return view('teller.pages.details.request', compact('shipment'));
    }

    
    public function index_user()
    {
        $userEmail = Auth::user()->email;
    
        $requestShipments = DB::table('request')
            ->select('id', 'shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 'brgy', 'city', 'province',
                     'zipcode', 'region', 'origin', 'destination', DB::raw("'request' as source"))
            ->where('email', $userEmail);
    
        $submittedRequestShipments = DB::table('submitted_request')
            ->select('id', 'shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 'brgy', 'city', 'province',
                     'zipcode', 'region', 'origin', 'destination', DB::raw("'submitted_request' as source"))
            ->where('email', $userEmail);
    
        $unionQuery = $requestShipments->unionAll($submittedRequestShipments);
    
        $sub = DB::table(DB::raw("({$unionQuery->toSql()}) as combined"))
            ->mergeBindings($unionQuery)
            ->orderByDesc('id');
    
        // Now select the latest entries by shipment_id using groupBy
        $shipments = DB::table(DB::raw("({$sub->toSql()}) as grouped"))
            ->mergeBindings($sub)
            ->select('*')
            ->groupBy('shipment_id')
            ->orderByDesc('id')
            ->paginate(20);
    
        return view('customer.pages.shipment.pending', compact('shipments'));
    }    
    

    public function show_user($id)
    { 
        $request = Request::where('shipment_id', $id)->get();
        $submitted_request = Submitted_Request::where('shipment_id', $id)->get();
     
        $shipment = $request->merge($submitted_request);
     
        return view('customer.pages.shipment.details.pending', compact('shipment'));
    }


    public function badge()
    {  
        $userEmail = Auth::user()->email;
     
        $pending = Request::where('email', $userEmail)
        ->select('shipment_id')
        ->distinct()
        ->union(
            Submitted_Request::where('email', $userEmail)
                ->select('shipment_id')
                ->distinct()
        )
        ->count('shipment_id');    
        $approved = ApprovedRequest::where('email', $userEmail)->distinct('shipment_id')->count('shipment_id');
        $queued = Queued::where('email', $userEmail)->distinct('shipment_id')->count('shipment_id');
        $inTransitCount = InTransitShipment::where('email', $userEmail)->distinct('shipment_id')->count('shipment_id');
        $dispatchedCount = DispatchedShipment::where('email', $userEmail)->distinct('shipment_id')->count('shipment_id');
        $cancelled = CancelledShipment::where('email', $userEmail)->distinct('shipment_id')->count('shipment_id');
        $claimed = ClaimedShipment::where('email', $userEmail)->distinct('shipment_id')->count('shipment_id');
        $unclaim = UnclaimShipment::where('email', $userEmail)->distinct('shipment_id')->count('shipment_id');
     
        return view('customer.pages.shipment_dashboard', compact('pending', 'approved', 'queued', 'inTransitCount', 'dispatchedCount', 'cancelled', 'claimed', 'unclaim')); 
    }    

    public function getShipmentCounts()
    {
        $userEmail = Auth::user()->email;
    
        $pending = Request::where('email', $userEmail)
            ->select('shipment_id')
            ->distinct()
            ->union(
                Submitted_Request::where('email', $userEmail)
                    ->select('shipment_id')
                    ->distinct()
            )
            ->count('shipment_id');
    
        $approved = ApprovedRequest::where('email', $userEmail)->distinct('shipment_id')->count('shipment_id');
        $queued = Queued::where('email', $userEmail)->distinct('shipment_id')->count('shipment_id');
        $inTransitCount = InTransitShipment::where('email', $userEmail)->distinct('shipment_id')->count('shipment_id');
        $dispatchedCount = DispatchedShipment::where('email', $userEmail)->distinct('shipment_id')->count('shipment_id');
        $cancelled = CancelledShipment::where('email', $userEmail)->distinct('shipment_id')->count('shipment_id');
        $claim = ClaimedShipment::where('email', $userEmail)->distinct('shipment_id')->count('shipment_id');
        $unclaim = UnclaimShipment::where('email', $userEmail)->distinct('shipment_id')->count('shipment_id');
     
        return response()->json([
            'pending' => $pending,
            'approved' => $approved,
            'queued' => $queued,
            'inTransit' => $inTransitCount,
            'dispatched' => $dispatchedCount,
            'cancelled' => $cancelled,
            'claim' => $claim,
            'unclaim' => $unclaim,
        ]);
    }
    
}
