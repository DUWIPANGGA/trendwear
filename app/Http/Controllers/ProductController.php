<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::with('user')
            ->latest()
            ->paginate($this->perPage);

        return $this->loadTheme('product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $isEdit = false;
        return $this->loadTheme('product.create',compact('isEdit'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'sku' => 'required|string|max:100|unique:shop_products,sku',
        'type' => 'required|in:simple,variable,grouped',
        'price' => 'required|numeric|min:0',
        'sale_price' => 'nullable|numeric|min:0|lt:price',
        'status' => 'required|in:draft,publish,archive',
        'stock_status' => 'required|in:in_stock,out_of_stock,on_backorder',
        'weight' => 'nullable|numeric|min:0',
        'publish_date' => 'nullable|date',
        'excerpt' => 'nullable|string',
        'body' => 'nullable|string',
        'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle file upload
    if ($request->hasFile('featured_image')) {
        $validated['featured_image'] = $request->file('featured_image')->store('products', 'public');
    }

    // Generate slug
    $validated['slug'] = Str::slug($request->name);
    $validated['user_id'] = auth()->id();

    // Create product
    $product = Product::create($validated);

    return redirect()->route('product.index')
        ->with('success', 'Product created successfully.');
}


    /**
     * Display the specified product.
     */
    public function show($id)
{
    $product = \App\Models\Product::findOrFail($id);
    
    return $this->loadTheme('product.show', [
        'product' => $product
    ]);
}

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $id)
    {
        $isEdit = true;
        return $this->loadTheme('product.edit', [
            'product' => $id,
            'isEdit' => $isEdit
        ]);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:shop_products,sku,'.$product->id,
            'type' => 'required|in:simple,variable,grouped',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'status' => 'required|in:draft,publish,archive',
            'stock_status' => 'required|in:in_stock,out_of_stock,on_backorder',
            'weight' => 'nullable|numeric|min:0',
            'publish_date' => 'nullable|date',
            'excerpt' => 'nullable|string',
            'body' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($product->featured_image) {
                Storage::disk('public')->delete($product->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('products', 'public');
        }

        // Update slug if name changed
        if ($request->name !== $product->name) {
            $validated['slug'] = Str::slug($request->name);
        }

        $product->update($validated);

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete associated image if exists
        if ($product->featured_image) {
            Storage::disk('public')->delete($product->featured_image);
        }

        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Product deleted successfully.');
    }
}