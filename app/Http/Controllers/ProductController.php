<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('products.*', 'users.name as user_name')
            ->join('users', 'products.user_id', '=', 'users.id')
            ->get();
        return view('admin.product.index', compact('products'));
    }
    public function create()
    {
        return view('admin.product.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nutrients' => 'required',
            'landType' => 'required',
            'age' => 'required',
            'condition' => 'required',
            'price' => 'required',
            'benefit' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        Product::create([
            'name' => $request->name,
            'nutrients' => $request->nutrients,
            'landType' => $request->landType,
            'age' => $request->age,
            'condition' => $request->condition,
            'price' => $request->price,
            'benefit' => $request->benefit,
            'image' => "/images/" . $imageName,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('product.create')->with('success', 'Product Created Successfully');
    }
    public function edit(Request $request, Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'nutrients' => 'required',
            'landType' => 'required',
            'age' => 'required',
            'condition' => 'required',
            'price' => 'required',
            'benefit' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $product->update([
                'name' => $request->name,
                'nutrients' => $request->nutrients,
                'landType' => $request->landType,
                'age' => $request->age,
                'condition' => $request->condition,
                'price' => $request->price,
                'benefit' => $request->benefit,
                'image' => "/images/" . $imageName,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $product->update([
                'name' => $request->name,
                'nutrients' => $request->nutrients,
                'landType' => $request->landType,
                'age' => $request->age,
                'condition' => $request->condition,
                'price' => $request->price,
                'benefit' => $request->benefit,
                'user_id' => auth()->user()->id,
            ]);
        }

        return redirect()->route('product.index')->with('success', 'Product Updated Successfully');
    }
    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product Deleted Successfully');
    }
}
