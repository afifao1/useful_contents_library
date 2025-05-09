<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-xl font-bold mb-4">Janrni tahrirlash</h2>

            <form action="{{ route('genres.update', $genre) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Janr nomi</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $genre->name) }}" class="mt-1 block w-full border rounded px-3 py-2" required>
                    @error('name')
                        <div class="text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Yangilash</button>
            </form>
        </div>
    </div>
</x-app-layout>
