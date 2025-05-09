<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-xl font-bold mb-4">Yangi janr qo‘shish</h2>

            <form action="{{ route('genres.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Janr nomi</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border rounded px-3 py-2" required>
                    @error('name')
                        <div class="text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Saqlash</button>
            </form>
        </div>
    </div>
</x-app-layout>
