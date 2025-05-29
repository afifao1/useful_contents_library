@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-body">
                    <h2 class="mb-3">{{ $content->title }}</h2>

                    <p class="text-muted mb-4">{{ $content->description }}</p>

                    @if ($content->url)
                        <p><strong>🔗 URL:</strong> <a href="{{ $content->url }}" target="_blank">{{ $content->url }}</a></p>
                    @endif

                    <p><strong>📁 Kategoriya:</strong> {{ $content->category->name ?? 'Nomaʼlum' }}</p>

                    <div class="mb-2">
                        <strong>🎭 Janrlar:</strong><br>
                        @forelse ($content->genres as $genre)
                            <span class="badge bg-info text-dark me-1">{{ $genre->name }}</span>
                        @empty
                            <span class="text-muted">Janr belgilanmagan</span>
                        @endforelse
                    </div>

                    <div class="mb-4">
                        <strong>✍️ Mualliflar:</strong><br>
                        @forelse ($content->authors as $author)
                            <span class="badge bg-secondary me-1">{{ $author->name }}</span>
                        @empty
                            <span class="text-muted">Muallif belgilanmagan</span>
                        @endforelse
                    </div>

                    {{-- Faqat admin foydalanuvchilarga ko‘rsatiladi --}}
                    @auth
                        @if(auth()->user()->is_admin)
                            <div class="d-flex gap-2 mb-3">
                                <a href="{{ route('contents.edit', $content->id) }}" class="btn btn-outline-primary">
                                    ✏️ Tahrirlash
                                </a>

                                <form action="{{ route('contents.destroy', $content->id) }}" method="POST" onsubmit="return confirm('Rostdan ham o‘chirmoqchimisiz?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        🗑️ O‘chirish
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth

                    <a href="{{ route('contents.index') }}" class="btn btn-outline-secondary">
                        ⬅️ Barcha kontentlar
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
