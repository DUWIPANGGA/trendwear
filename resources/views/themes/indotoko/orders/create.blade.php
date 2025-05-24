@extends('themes.indotoko.layouts.admin')

@section('title', 'Create New Order')

@section('content')
<div class="ml-0 lg:ml-2 pt-16 min-h-screen">
    <div class="p-4 md:p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Create New Order</h1>
            <a href="{{ route('orders.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <form method="POST" action="{{ route('orders.store') }}">
                @csrf

                <div class="p-6 space-y-6">
                    <!-- Customer Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-800">Customer Information</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="customer_first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                                <input type="text" id="customer_first_name" name="customer_first_name" 
                                       class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('customer_first_name') border-red-500 @enderror" 
                                       value="{{ old('customer_first_name') }}" required>
                                @error('customer_first_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="customer_last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                                <input type="text" id="customer_last_name" name="customer_last_name" 
                                       class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('customer_last_name') border-red-500 @enderror" 
                                       value="{{ old('customer_last_name') }}" required>
                                @error('customer_last_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" id="customer_email" name="customer_email" 
                                   class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('customer_email') border-red-500 @enderror" 
                                   value="{{ old('customer_email') }}" required>
                            @error('customer_email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                            <input type="text" id="customer_phone" name="customer_phone" 
                                   class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('customer_phone') border-red-500 @enderror" 
                                   value="{{ old('customer_phone') }}" required>
                            @error('customer_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-800">Shipping Information</h3>
                        
                        <div>
                            <label for="customer_address1" class="block text-sm font-medium text-gray-700 mb-1">Address Line 1 *</label>
                            <input type="text" id="customer_address1" name="customer_address1" 
                                   class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('customer_address1') border-red-500 @enderror" 
                                   value="{{ old('customer_address1') }}" required>
                            @error('customer_address1')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="customer_address2" class="block text-sm font-medium text-gray-700 mb-1">Address Line 2</label>
                            <input type="text" id="customer_address2" name="customer_address2" 
                                   class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('customer_address2') border-red-500 @enderror" 
                                   value="{{ old('customer_address2') }}">
                            @error('customer_address2')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="customer_city" class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                                <input type="text" id="customer_city" name="customer_city" 
                                       class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('customer_city') border-red-500 @enderror" 
                                       value="{{ old('customer_city') }}" required>
                                @error('customer_city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="customer_province" class="block text-sm font-medium text-gray-700 mb-1">Province *</label>
                                <input type="text" id="customer_province" name="customer_province" 
                                       class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('customer_province') border-red-500 @enderror" 
                                       value="{{ old('customer_province') }}" required>
                                @error('customer_province')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="customer_postcode" class="block text-sm font-medium text-gray-700 mb-1">Postal Code *</label>
                                <input type="text" id="customer_postcode" name="customer_postcode" 
                                       class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('customer_postcode') border-red-500 @enderror" 
                                       value="{{ old('customer_postcode') }}" required>
                                @error('customer_postcode')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Order Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-800">Order Information</h3>
                        
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                            <select id="status" name="status" 
                                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror" required>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="customer_note" class="block text-sm font-medium text-gray-700 mb-1">Customer Note</label>
                            <textarea id="customer_note" name="customer_note" rows="3" 
                                      class="w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('customer_note') border-red-500 @enderror">{{ old('customer_note') }}</textarea>
                            @error('customer_note')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                    <button type="reset" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Reset
                    </button>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Create Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection