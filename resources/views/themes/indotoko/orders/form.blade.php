@extends('themes.indotoko.layouts.admin')

@section('title', $order->exists ? 'Edit Order' : 'Create Order')

@section('content')
<div class="ml-0 lg:ml-64 pt-16 min-h-screen">
    <div class="p-4 md:p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                {{ $order->exists ? 'Edit Order' : 'Create New Order' }}
            </h1>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <form method="POST" action="{{ $order->exists ? route('admin.orders.update', $order) : route('admin.orders.store') }}">
                @csrf
                @if($order->exists) @method('PUT') @endif

                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Customer Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-800">Customer Information</h3>
                            
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700">Customer</label>
                                <select id="user_id" name="user_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id', $order->user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="customer_first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input type="text" id="customer_first_name" name="customer_first_name" value="{{ old('customer_first_name', $order->customer_first_name) }}" 
                                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label for="customer_last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                    <input type="text" id="customer_last_name" name="customer_last_name" value="{{ old('customer_last_name', $order->customer_last_name) }}" 
                                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <div>
                                <label for="customer_email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email', $order->customer_email) }}" 
                                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', $order->customer_phone) }}" 
                                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <!-- Order Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-800">Order Information</h3>
                            
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ old('status', $order->status) == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @if($order->exists && $order->status == 'cancelled')
                            <div>
                                <label for="cancellation_note" class="block text-sm font-medium text-gray-700">Cancellation Note</label>
                                <textarea id="cancellation_note" name="cancellation_note" rows="3" 
                                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('cancellation_note', $order->cancellation_note) }}</textarea>
                            </div>
                            @endif

                            <div>
                                <label for="customer_note" class="block text-sm font-medium text-gray-700">Customer Note</label>
                                <textarea id="customer_note" name="customer_note" rows="3" 
                                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('customer_note', $order->customer_note) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-800">Shipping Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="customer_address1" class="block text-sm font-medium text-gray-700">Address Line 1</label>
                                <input type="text" id="customer_address1" name="customer_address1" value="{{ old('customer_address1', $order->customer_address1) }}" 
                                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="customer_address2" class="block text-sm font-medium text-gray-700">Address Line 2 (Optional)</label>
                                <input type="text" id="customer_address2" name="customer_address2" value="{{ old('customer_address2', $order->customer_address2) }}" 
                                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="customer_city" class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" id="customer_city" name="customer_city" value="{{ old('customer_city', $order->customer_city) }}" 
                                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="customer_province" class="block text-sm font-medium text-gray-700">Province</label>
                                <input type="text" id="customer_province" name="customer_province" value="{{ old('customer_province', $order->customer_province) }}" 
                                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label for="customer_postcode" class="block text-sm font-medium text-gray-700">Postal Code</label>
                                <input type="text" id="customer_postcode" name="customer_postcode" value="{{ old('customer_postcode', $order->customer_postcode) }}" 
                                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                    <button type="reset" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-undo mr-2"></i> Reset
                    </button>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-2"></i> Save Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection