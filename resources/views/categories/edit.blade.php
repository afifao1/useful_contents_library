@extends('layouts.app')

@section('header')
    <h1>Edit Category</h1>
@endsection

@section('content')
    <div class="container mx-auto py-6">
        <form action="{{ route('categories.update', $category) }}" method="POST" class="w-full max-w-lg mx-auto bg-white dark:bg-gray-800 shadow-md rounded p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Category Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required
                >
                @error('name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Category</button>
            </div>
        </form>
    </div>
@endsection
