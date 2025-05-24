@extends('themes.indotoko.layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class="ml-0 lg:ml-64 pt-16 min-h-screen">
    <div class="p-4 md:p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Order #{{ $order->code }}</h1>
                <p class="text-sm text-gray-500">Placed on {{ $order->order_date->format('F j, Y \a\t g:i A') }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.orders.edit', $order) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Order Summary -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800">Order Items</h3>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <!-- Order items would be listed here -->
                        <div class="px-6 py-4">
                            <p class="text-gray-500">Order items would be displayed here</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800">Order Notes</h3>
                    </div>
                    <div class="p-6">
                        @if($order->customer_note)
                            <p class="text-gray-800">{{ $order->customer_note }}</p>
                        @else
                            <p class="text-gray-500">No notes for this order</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="space-y-6">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800">Order Summary</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">Rp {{ number_format($order->base_total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax ({{ $order->tax_percent }}%)</span>
                            <span class="font-medium">Rp {{ number_format($order->tax_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Discount ({{ $order->discount_percent }}%)</span>
                            <span class="font-medium">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex justify-between">
                            <span class="font-medium text-gray-800">Total</span>
                            <span class="font-bold text-lg">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800">Customer Details</h3>
                    </div>
                    <div class="p-6 space-y-2">
                        <p class="font-medium">{{ $order->customer_first_name }} {{ $order->customer_last_name }}</p>
                        <p class="text-gray-600">{{ $order->customer_email }}</p>
                        <p class="text-gray-600">{{ $order->customer_phone }}</p>
                        <div class="pt-2 mt-2 border-t border-gray-200">
                            <p class="text-gray-800">{{ $order->customer_address1 }}</p>
                            @if($order->customer_address2)
                                <p class="text-gray-800">{{ $order->customer_address2 }}</p>
                            @endif
                            <p class="text-gray-800">{{ $order->customer_city }}, {{ $order->customer_province }} {{ $order->customer_postcode }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800">Order Status</h3>
                    </div>
                    <div class="p-6">
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                            {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : 
                               ($order->status == 'processing' ? 'bg-blue-100 text-blue-800' : 
                               ($order->status == 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }}">
                            {{ ucfirst($order->status) }}
                        </span>

                        @if($order->status == 'completed' && $order->approvedBy)
                            <p class="mt-2 text-sm text-gray-500">
                                Approved by {{ $order->approvedBy->name }} on {{ $order->approved_at->format('M j, Y g:i A') }}
                            </p>
                        @endif

                        @if($order->status == 'cancelled' && $order->cancelledBy)
                            <p class="mt-2 text-sm text-gray-500">
                                Cancelled by {{ $order->cancelledBy->name }} on {{ $order->cancelled_at->format('M j, Y g:i A') }}
                            </p>
                            @if($order->cancellation_note)
                                <div class="mt-2 p-3 bg-gray-50 rounded">
                                    <p class="text-sm font-medium text-gray-700">Cancellation Note:</p>
                                    <p class="text-sm text-gray-600">{{ $order->cancellation_note }}</p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection