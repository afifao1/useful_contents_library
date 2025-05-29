@extends('layouts.app')

@section('header')
    Barcha Kontentlar
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Faqat admin foydalanuvchiga "Yangi Kontent" tugmasi --}}
    @auth
        @if(auth()->user()->is_admin)
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('contents.create') }}" class="btn btn-primary">+ Yangi Kontent</a>
            </div>
        @endif
    @endauth

    <div class="row">
        @foreach($contents as $content)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <h5 class="card-title">{{ $content->title }}</h5>
                        <p class="card-text">{{ Str::limit($content->description, 100) }}</p>

                        @if($content->authors && $content->authors->count())
                            <p>
                                <strong>Mualliflar:</strong><br>
                                @foreach($content->authors as $author)
                                    <span class="badge bg-primary">{{ $author->name }}</span>
                                @endforeach
                            </p>
                        @endif

                        @if(Str::contains($content->url, ['youtube', 'spotify', 't.me', 'iframe']))
                            <div class="ratio ratio-16x9 mb-3">
                                <iframe src="{{ $content->url }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        @else
                            <a href="{{ $content->url }}" target="_blank" class="btn btn-outline-secondary mb-3">Ko‘rish</a>
                        @endif

                        <a href="{{ route('contents.show', $content->id) }}" class="btn btn-sm btn-outline-primary">Batafsil</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
