@extends('themes.indotoko.layouts.admin')

@section('title', 'Activity Log Details')

@section('content')
<div class="ml-0 lg:ml-64 pt-16 min-h-screen">
    <div class="p-4 md:p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Activity Log Details</h1>
            <a href="{{ route('admin.activity-logs.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Details -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800">Activity Information</h3>
                    </div>
                    <div class="p-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <p class="text-gray-900">{{ $activityLog->description }}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Action Type</label>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $activityLog->action === 'created' ? 'bg-green-100 text-green-800' : 
                                       ($activityLog->action === 'updated' ? 'bg-blue-100 text-blue-800' : 
                                       ($activityLog->action === 'deleted' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                    {{ ucfirst($activityLog->action) }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                <p class="text-gray-900">{{ $activityLog->created_at->format('d F Y H:i:s') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Technical Details -->
                <div class="mt-6 bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800">Technical Information</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">IP Address</label>
                                <p class="text-gray-900">{{ $activityLog->ip_address }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">HTTP Method</label>
                                <p class="text-gray-900">{{ $activityLog->method }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                            <p class="text-gray-900 break-all">{{ $activityLog->url }}</p>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">User Agent</label>
                            <p class="text-gray-900">{{ $activityLog->user_agent }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Information -->
            <div>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800">User Information</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-16 w-16">
                                <img class="h-16 w-16 rounded-full" 
                                     src="{{ $activityLog->user->avatar ?? asset('images/default-avatar.png') }}" 
                                     alt="{{ $activityLog->user->name }}">
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">{{ $activityLog->user->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $activityLog->user->email }}</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    Role: <span class="font-medium">{{ $activityLog->user->role }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('admin.users.show', $activityLog->user) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-user mr-2"></i> View User Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-6 bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800">Actions</h3>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('admin.activity-logs.destroy', $activityLog) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash mr-2"></i> Delete Log
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection