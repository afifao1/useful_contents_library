@extends('layouts.app')

@section('header')
    Bosh Sahifa – Barcha Kontentlar
@endsection

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-center">Content Hub</h1>

        <div class="row">
            @foreach($contents as $content)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $content->title }}</h5>
                            <p class="card-text">{{ Str::limit($content->description, 100) }}</p>

                            @if($content->authors && $content->authors->count())
                                <p>
                                    <strong>Mualliflar:</strong><br>
                                    @foreach($content->authors as $author)
                                        <span class="badge bg-secondary">{{ $author->name }}</span>
                                    @endforeach
                                </p>
                            @endif

                            @php
                                $embedUrl = $content->url;

                                if (Str::contains($content->url, 'youtube.com/watch')) {
                                    parse_str(parse_url($content->url, PHP_URL_QUERY), $queryParams);
                                    $videoId = $queryParams['v'] ?? null;
                                    if ($videoId) {
                                        $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                    }
                                }

                                if (Str::contains($content->url, 'spotify.com')) {
                                    $embedUrl = str_replace('open.spotify.com', 'open.spotify.com/embed', $content->url);
                                }

                                if (Str::contains($content->url, 't.me')) {
                                    $embedUrl = 'https://t.me/' . trim(parse_url($content->url, PHP_URL_PATH), '/');
                                }
                            @endphp

                            @if(Str::contains($content->url, ['youtube', 'spotify']))
                                <div class="ratio ratio-16x9 mb-3">
                                    <iframe src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                                </div>
                            @elseif(Str::contains($content->url, 't.me'))
                                <p><a href="{{ $embedUrl }}" class="btn btn-outline-info mb-3" target="_blank">Telegramga o'tish</a></p>
                            @elseif(Str::contains($content->url, ['.jpg', '.jpeg', '.png', '.gif', '.webp']))
                                <img src="{{ $content->url }}" class="img-fluid mb-3" alt="Image">
                            @elseif(Str::contains($content->url, ['.mp4', '.webm']))
                                <video controls class="w-100 mb-3">
                                    <source src="{{ $content->url }}" type="video/mp4">
                                    Sizning brauzeringiz video formatini qo‘llamaydi.
                                </video>
                            @else
                                <a href="{{ $content->url }}" target="_blank" class="btn btn-outline-secondary mb-3">Ko‘rish</a>
                            @endif

                            <a href="{{ route('contents.show', $content->id) }}" class="btn btn-sm btn-outline-primary">Batafsil</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
