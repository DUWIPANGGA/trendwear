    <!-- resources/views/themes/indotoko/products/form.blade.php -->
    @php
        $isEdit = isset($product);
        $route = $isEdit ? route('products.update', $product->id) : route('product.store');
    @endphp

    <form method="POST" action="{{ $route }}" enctype="multipart/form-data">
        @if($isEdit) @method('PUT') @endif
        @csrf
        
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $isEdit ? 'Edit' : 'Create' }} Product</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name">Product Name *</label>
                            <input type="text" name="name" id="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                value="{{ old('name', $product->name ?? '') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sku">SKU *</label>
                                    <input type="text" name="sku" id="sku" 
                                        class="form-control @error('sku') is-invalid @enderror" 
                                        value="{{ old('sku', $product->sku ?? '') }}" required>
                                    @error('sku')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Product Type *</label>
                                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                        <option value="simple" {{ old('type', $product->type ?? '') == 'simple' ? 'selected' : '' }}>Simple Product</option>
                                        <option value="variable" {{ old('type', $product->type ?? '') == 'variable' ? 'selected' : '' }}>Variable Product</option>
                                        <option value="grouped" {{ old('type', $product->type ?? '') == 'grouped' ? 'selected' : '' }}>Grouped Product</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Regular Price *</label>
                                    <input type="number" name="price" id="price" 
                                        class="form-control @error('price') is-invalid @enderror" 
                                        value="{{ old('price', $product->price ?? '') }}" step="0.01" required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sale_price">Sale Price</label>
                                    <input type="number" name="sale_price" id="sale_price" 
                                        class="form-control @error('sale_price') is-invalid @enderror" 
                                        value="{{ old('sale_price', $product->sale_price ?? '') }}" step="0.01">
                                    @error('sale_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="excerpt">Short Description</label>
                            <textarea name="excerpt" id="excerpt" rows="3" 
                                    class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $product->excerpt ?? '') }}</textarea>
                            @error('excerpt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="body">Description</label>
                            <textarea name="body" id="body" rows="6" 
                                    class="form-control @error('body') is-invalid @enderror">{{ old('body', $product->body ?? '') }}</textarea>
                            @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status *</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="draft" {{ old('status', $product->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="publish" {{ old('status', $product->status ?? '') == 'publish' ? 'selected' : '' }}>Publish</option>
                                <option value="archive" {{ old('status', $product->status ?? '') == 'archive' ? 'selected' : '' }}>Archive</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="publish_date">Publish Date</label>
                            <input type="datetime-local" name="publish_date" id="publish_date" 
                                class="form-control @error('publish_date') is-invalid @enderror" 
                                value="">
                            @error('publish_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="stock_status">Stock Status *</label>
                            <select name="stock_status" id="stock_status" class="form-control @error('stock_status') is-invalid @enderror" required>
                                <option value="in_stock" {{ old('stock_status', $product->stock_status ?? '') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                <option value="out_of_stock" {{ old('stock_status', $product->stock_status ?? '') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                <option value="on_backorder" {{ old('stock_status', $product->stock_status ?? '') == 'on_backorder' ? 'selected' : '' }}>On Backorder</option>
                            </select>
                            @error('stock_status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="weight">Weight (kg)</label>
                            <input type="number" name="weight" id="weight" 
                                class="form-control @error('weight') is-invalid @enderror" 
                                value="{{ old('weight', $product->weight ?? '') }}" step="0.01">
                            @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="featured_image">Featured Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('featured_image') is-invalid @enderror" 
                                    id="featured_image" name="featured_image">
                                <label class="custom-file-label" for="featured_image">Choose file</label>
                            </div>
                            @error('featured_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @if($isEdit && $product->featured_image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/'.$product->featured_image) }}" alt="Featured Image" class="img-thumbnail" width="150">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Product</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
        // Show file name when file is selected
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = document.getElementById("featured_image").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>
    @endpush