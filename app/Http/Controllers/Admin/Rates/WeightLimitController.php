<?php
namespace App\Http\Controllers\Admin\Rates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WeightLimit;

class WeightLimitController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric|min:1|max:1000'
        ]);

        $weightLimit = WeightLimit::first();
        if ($weightLimit) {
            $weightLimit->update(['weight' => $request->weight]);
        } else {
            WeightLimit::create(['weight' => $request->weight]);
        }

        return redirect()->back()->with('success', 'Weight limit updated!');
    }

    public function getWeight()
    {
        $weight = WeightLimit::first();
        return response()->json(['weight' => $weight ? $weight->weight : 50]);
    }


    public function getWeightLimit()
    {
        $weightLimit = WeightLimit::value('weight'); // Fetch the 'weight' column

        if (!$weightLimit) {
            return response()->json(['error' => 'Weight limit not found'], 404);
        }

        return response()->json(['weight' => $weightLimit]);
    }
}
