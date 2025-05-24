@extends('themes.indotoko.layouts.admin')

@section('title', $isEdit ? 'Edit Product' : 'Create Product')

@section('content')
<div class="ml-0 lg:ml-2 pt-16 min-h-screen">
    <div class="p-4 md:p-6">
        @php
            $isEdit = isset($product);
            $route = $isEdit ? route('product.update', $product->id) : route('product.store');
        @endphp

        <form method="POST" action="{{ $route }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md overflow-hidden">
            @if($isEdit) @method('PUT') @endif
            @csrf
            
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">{{ $isEdit ? 'Edit' : 'Create' }} Product</h3>
            </div>
            
            <!-- Card Body -->
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column (8/12) -->
                    <div class="lg:col-span-2 space-y-4">
                        <!-- Product Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                            <input type="text" name="name" id="name" 
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror" 
                                value="{{ old('name', $product->name ?? '') }}" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SKU and Type -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- SKU -->
                            <div>
                                <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">SKU *</label>
                                <input type="text" name="sku" id="sku" 
                                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('sku') border-red-500 @enderror" 
                                    value="{{ old('sku', $product->sku ?? '') }}" required>
                                @error('sku')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Product Type -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Product Type *</label>
                                <select name="type" id="type" 
                                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('type') border-red-500 @enderror" required>
                                    <option value="simple" {{ old('type', $product->type ?? '') == 'simple' ? 'selected' : '' }}>Simple Product</option>
                                    <option value="variable" {{ old('type', $product->type ?? '') == 'variable' ? 'selected' : '' }}>Variable Product</option>
                                    <option value="grouped" {{ old('type', $product->type ?? '') == 'grouped' ? 'selected' : '' }}>Grouped Product</option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Prices -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Regular Price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Regular Price *</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="number" name="price" id="price" 
                                        class="block w-full pl-7 pr-12 py-2 border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('price') border-red-500 @enderror" 
                                        value="{{ old('price', $product->price ?? '') }}" step="0.01" required>
                                </div>
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Sale Price -->
                            <div>
                                <label for="sale_price" class="block text-sm font-medium text-gray-700 mb-1">Sale Price</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input type="number" name="sale_price" id="sale_price" 
                                        class="block w-full pl-7 pr-12 py-2 border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('sale_price') border-red-500 @enderror" 
                                        value="{{ old('sale_price', $product->sale_price ?? '') }}" step="0.01">
                                </div>
                                @error('sale_price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Short Description -->
                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                            <textarea name="excerpt" id="excerpt" rows="3"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('excerpt') border-red-500 @enderror">{{ old('excerpt', $product->excerpt ?? '') }}</textarea>
                            @error('excerpt')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="body" id="body" rows="6"
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('body') border-red-500 @enderror">{{ old('body', $product->body ?? '') }}</textarea>
                            @error('body')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column (4/12) -->
                    <div class="space-y-4">
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                            <select name="status" id="status" 
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror" required>
                                <option value="draft" {{ old('status', $product->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="publish" {{ old('status', $product->status ?? '') == 'publish' ? 'selected' : '' }}>Publish</option>
                                <option value="archive" {{ old('status', $product->status ?? '') == 'archive' ? 'selected' : '' }}>Archive</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Publish Date -->
                        <div>
                            <label for="publish_date" class="block text-sm font-medium text-gray-700 mb-1">Publish Date</label>
                            <input type="datetime-local" name="publish_date" id="publish_date" 
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('publish_date') border-red-500 @enderror" 
                                value="{{ old('publish_date', $product->publish_date ?? '') }}">
                            @error('publish_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stock Status -->
                        <div>
                            <label for="stock_status" class="block text-sm font-medium text-gray-700 mb-1">Stock Status *</label>
                            <select name="stock_status" id="stock_status" 
                                class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('stock_status') border-red-500 @enderror" required>
                                <option value="in_stock" {{ old('stock_status', $product->stock_status ?? '') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                <option value="out_of_stock" {{ old('stock_status', $product->stock_status ?? '') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                <option value="on_backorder" {{ old('stock_status', $product->stock_status ?? '') == 'on_backorder' ? 'selected' : '' }}>On Backorder</option>
                            </select>
                            @error('stock_status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Weight -->
                        <div>
                            <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">Weight (kg)</label>
                            <div class="relative rounded-md shadow-sm">
                                <input type="number" name="weight" id="weight" 
                                    class="block w-full pl-3 pr-12 py-2 border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('weight') border-red-500 @enderror" 
                                    value="{{ old('weight', $product->weight ?? '') }}" step="0.01">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">kg</span>
                                </div>
                            </div>
                            @error('weight')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Featured Image -->
                        <div>
                            <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
                            <div class="mt-1 flex items-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                    <span>Upload a file</span>
                                    <input type="file" id="featured_image" name="featured_image" 
                                        class="sr-only @error('featured_image') border-red-500 @enderror">
                                </label>
                                <p class="pl-1 text-sm text-gray-500" id="file-name">or drag and drop</p>
                            </div>
                            @error('featured_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @if($isEdit && $product->featured_image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/'.$product->featured_image) }}" alt="Featured Image" class="h-24 w-24 rounded-md object-cover">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Card Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('product.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Save Product
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Show file name when file is selected
    document.getElementById('featured_image').addEventListener('change', function(e) {
        var fileName = e.target.files[0]?.name || 'No file chosen';
        document.getElementById('file-name').textContent = fileName;
    });
</script>
@endpush
@endsection