<!-- resources/views/themes/indotoko/products/show.blade.php -->
@extends('themes.indotoko.layouts.admin')

@section('title', 'Product Detail')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Product Detail</h3>
        <div class="card-tools">
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h4>{{ $product->name }}</h4>
                        <p class="text-muted">SKU: {{ $product->sku }}</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <span class="badge badge-{{ $product->status == 'publish' ? 'success' : 'warning' }}">
                            {{ ucfirst($product->status) }}
                        </span>
                        <span class="badge badge-info ml-2">
                            {{ ucfirst($product->type) }} Product
                        </span>
                    </div>
                </div>

                <div class="mb-4">
                    <h5>Description</h5>
                    <p>{!! nl2br(e($product->body)) !!}</p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Pricing</h5>
                        <table class="table table-sm">
                            <tr>
                                <th>Regular Price</th>
                                <td>{{ format_currency($product->price) }}</td>
                            </tr>
                            @if($product->sale_price)
                            <tr>
                                <th>Sale Price</th>
                                <td class="text-danger">{{ format_currency($product->sale_price) }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Inventory</h5>
                        <table class="table table-sm">
                            <tr>
                                <th>Stock Status</th>
                                <td>{{ ucwords(str_replace('_', ' ', $product->stock_status)) }}</td>
                            </tr>
                            <tr>
                                <th>Weight</th>
                                <td>{{ $product->weight ? $product->weight.' kg' : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Product Image</h5>
                    </div>
                    <div class="card-body text-center">
                        @if($product->featured_image)
                            <img src="{{ asset('storage/'.$product->featured_image) }}" alt="Product Image" class="img-fluid">
                        @else
                            <div class="text-muted py-5">No Image Available</div>
                        @endif
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Additional Information</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <th>Created At</th>
                                <td>{{ $product->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $product->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                            @if($product->publish_date)
                            <tr>
                                <th>Publish Date</th>
                                <td>{{ $product->publish_date->format('d M Y H:i') }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection