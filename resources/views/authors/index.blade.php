<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-xl font-bold mb-4">Authorlar ro'yxati</h2>

            <a href="{{ route('authors.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Yangi qo‘shish</a>

            @if(session('success'))
                <div class="mt-4 text-green-600">{{ session('success') }}</div>
            @endif

            <table class="mt-4 w-full border text-white">
                <thead>
                    <tr>
                        <th>Ism</th>
                        <th>URL</th>
                        <th>Amallar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($authors as $author)
                        <tr>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->url }}</td>
                            <td>
                                <a href="{{ route('authors.edit', $author) }}" class="text-blue-600">Tahrirlash</a>
                                <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display:inline;">
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
