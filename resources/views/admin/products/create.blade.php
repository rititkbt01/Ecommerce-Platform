@extends('layouts.admin')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-3xl font-bold mb-8">Add New Product</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow">
        @csrf

        <!-- Category -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Category</label>
            <select name="category_id" class="w-full px-4 py-2 border rounded-lg @error('category_id') border-red-500 @enderror">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Name -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Product Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border rounded-lg @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Price -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Price</label>
            <input type="number" name="price" value="{{ old('price') }}" step="0.01" class="w-full px-4 py-2 border rounded-lg @error('price') border-red-500 @enderror">
            @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Stock -->
        <div class="mb-6">
            <label class="block text-gray-700 mb-2">Stock Quantity</label>
            <input type="number" name="stock" value="{{ old('stock') }}" class="w-full px-4 py-2 border rounded-lg @error('stock') border-red-500 @enderror">
            @error('stock')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Create Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection