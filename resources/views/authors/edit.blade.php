<x-app-layout>
    <div class="py-12 max-w-xl mx-auto">
        <h2 class="text-xl font-bold mb-4">Muallifni tahrirlash</h2>

        <form action="{{ route('authors.update', $author) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="block mb-2">Ism:</label>
            <input type="text" name="name" value="{{ $author->name }}" class="w-full mb-4 border p-2" required>

            <label class="block mb-2">URL:</label>
            <input type="url" name="url" value="{{ $author->url }}" class="w-full mb-4 border p-2">

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Yangilash</button>
        </form>
    </div>
</x-app-layout>
