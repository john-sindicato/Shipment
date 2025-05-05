<?php

namespace App\Http\Controllers\Admin\Rates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rates;
use App\Models\Category;
use DB;  

class RatesController extends Controller
{
    public function rates(Request $request)
    {
        $request->validate([
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'delivery_days' => 'required|integer|min:1',
        ]);
 
        $existingRate = Rates::where('origin', $request->origin)
            ->where('destination', $request->destination)
            ->first();

        if ($existingRate) {
            if ($existingRate->status === 'open') {
                return redirect()->back()->with('error', 'Route already exists.');
            } elseif ($existingRate->status === 'deleted') {
                $existingRate->update([
                    'price' => $request->price,
                    'delivery_days' => $request->delivery_days,
                    'status' => 'open',
                ]);

                return redirect()->route('admin.pages.rates.rates')->with('success', 'Rate reactivated successfully.');
            }
        }
 
        Rates::create([
            'origin' => $request->origin,
            'destination' => $request->destination,
            'price' => $request->price,
            'delivery_days' => $request->delivery_days,
            'status' => 'open',
        ]);

        return redirect()->route('admin.pages.rates.rates')->with('success', 'Added successfully.');
    }

    public function index()
    {
        $shippingRates = Rates::where('status', '!=', 'deleted')
            ->orderBy('id', 'desc')
            ->paginate(20);
    
        return view('admin.pages.rates.rates', compact('shippingRates'));
    }    
    

    public function edit($id)
    {
        $rate = Rates::findOrFail($id);
        return view('admin.pages.rates.edit_port', compact('rate'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'delivery_days' => 'required|integer|min:1',
        ]);

        $rate = Rates::findOrFail($id);
        $rate->update([
            'origin' => $request->origin,
            'destination' => $request->destination,
            'price' => $request->price,
            'delivery_days' => $request->delivery_days,
        ]);

        return redirect()->route('admin.pages.rates.rates')->with('success', 'Updated successfully.');
    }

        
    public function destroy_port($id)
    {
        $rate = Rates::findOrFail($id);
    
        try {
            $rate->update(['status' => 'deleted']);
    
            return redirect()->route('admin.pages.rates.rates')->with('success', 'Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.pages.rates.rates')->with('error', 'An error occurred. Please try again.');
        }
    }
    

    

    public function updateStatus(Request $request, $id)
    {
        $rate = Rates::findOrFail($id);
        $rate->status = $request->status;
        $rate->save();

        return response()->json(['success' => true, 'status' => $rate->status]);
    }


    public function route()
    {
        $rates = Rates::where('status', '!=', 'deleted')
                      ->orderBy('origin', 'asc')
                      ->get();
    
        $messages = [
            "You can switch the route upon clicking the 'Request a Quote' button.",
        ];
    
        return view('customer.pages.routes', compact('rates', 'messages'));
    }    
    

    public function request_form(Request $request)
    {
        $categories = Category::orderBy('id', 'desc')->get();

        $origin = $request->query('origin', '');
        $destination = $request->query('destination', '');
        return view('customer.pages.request_form', compact('categories', 'origin', 'destination'));
    }


}
