<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-xl font-bold mb-4">Janrlar ro'yxati</h2>

            <a href="{{ route('genres.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Yangi janr qo‘shish</a>

            @if(session('success'))
                <div class="mt-4 text-green-600">{{ session('success') }}</div>
            @endif

            <table class="mt-4 w-full border text-white">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Amallar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($genres as $genre)
                        <tr>
                            <td>{{ $genre->name }}</td>
                            <td>
                                <a href="{{ route('genres.edit', $genre) }}" class="text-blue-600">Tahrirlash</a>
                                <form action="{{ route('genres.destroy', $genre) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 ml-2" onclick="return confirm('Ishonchingiz komilmi?')">O‘chirish</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
