@extends('themes.indotoko.layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="ml-0 lg:ml-2 pt-16 min-h-screen bg-gray-50">
    <div class="p-4 md:p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Edit Kategori: <span class="text-blue-600">{{ $category->name }}</span></h2>
            <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 bg-white hover:bg-gray-100 transition-colors duration-200 shadow-sm">
                <i class="fas fa-arrow-left mr-2 text-gray-500"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-gray-100 bg-white">
                <h4 class="text-lg font-medium text-gray-800">Form Edit Kategori</h4>
            </div>

            <!-- Card Body -->
            <div class="p-6">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Nama Kategori -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-600 mb-1">
                                Nama Kategori <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-300 @error('name') border-red-300 @enderror"
                                   placeholder="Contoh: Elektronik" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori Induk -->
                        <div>
                            <label for="parent_id" class="block text-sm font-medium text-gray-600 mb-1">
                                Kategori Induk
                            </label>
                            <select id="parent_id" name="parent_id"
                                    class="w-full px-4 py-2 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-300 @error('parent_id') border-red-300 @enderror">
                                <option value="">-- Pilih Kategori Induk --</option>
                                @foreach($parentCategories as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Slug Field -->
                    <div class="mb-6">
                        <label for="slug" class="block text-sm font-medium text-gray-600 mb-1">
                            Slug URL
                        </label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $category->slug) }}"
                               class="w-full px-4 py-2 border border-gray-200 rounded-lg shadow-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-300 @error('slug') border-red-300 @enderror"
                               readonly>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Slug akan otomatis digenerate dari nama kategori</p>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex space-x-3 pt-2">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-100 transition-colors duration-200 shadow-sm">
                            <i class="fas fa-save mr-2"></i> Perbarui
                        </button>
                        <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 transition-colors duration-200 shadow-sm">
                            <i class="fas fa-times mr-2"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto generate slug when name changes
    document.getElementById('name').addEventListener('input', function() {
        document.getElementById('slug').value = this.value.toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');
    });
</script>
@endpush