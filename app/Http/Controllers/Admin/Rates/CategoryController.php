<?php

namespace App\Http\Controllers\Admin\Rates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function store_category(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255'
        ]);
    
        $existingCategory = Category::where('category', $request->category)->first();
    
        if ($existingCategory) {
            if ($existingCategory->status === 'active') {
                return redirect()->back()->with('error', 'Category already exists.');
            } elseif ($existingCategory->status === 'deleted') {
                $existingCategory->update(['status' => 'active']);
                return redirect()->route('admin.pages.rates.categories')->with('success', 'Category reactivated successfully.');
            }
        }
     
        Category::create([
            'category' => $request->category,
            'status' => 'active'
        ]);
    
        return redirect()->route('admin.pages.rates.categories')->with('success', 'Category added successfully.');
    }
    

    public function index()
    {
        $categories = Category::where('status', 'active')
        ->orderBy('id', 'desc')
        ->paginate(20);
        return view('admin.pages.rates.categories', compact('categories'));
    }
    

    public function edit($id)
    {
        $rate = Rates::findOrFail($id);
        return view('admin.pages.rates.edit_port', compact('rate'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:255'
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'category' => $request->category,
        ]);

        return redirect()->route('admin.pages.rates.categories')->with('success', 'Updated successfully.');
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);
    
        try {
            $category->update(['status' => 'deleted']); 
            return redirect()->route('admin.pages.rates.categories')->with('success', 'Deleted Successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.pages.rates.categories')->with('error', 'An error occurred. Please try again.');
        }
    }    
    
}

