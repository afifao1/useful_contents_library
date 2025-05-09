<x-app-layout>
    <div class="py-12 max-w-xl mx-auto">
        <h2 class="text-xl font-bold mb-4">Yangi muallif qo‘shish</h2>

        <form action="{{ route('authors.store') }}" method="POST">
            @csrf

            <label class="block mb-2">Ism:</label>
            <input type="text" name="name" class="w-full mb-4 border p-2" required>

            <label class="block mb-2">URL (ixtiyoriy):</label>
            <input type="url" name="url" class="w-full mb-4 border p-2">

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Saqlash</button>
        </form>
    </div>
</x-app-layout>
