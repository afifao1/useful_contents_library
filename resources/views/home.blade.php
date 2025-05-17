@extends('layouts.app')

@section('header')
    Bosh Sahifa – Barcha Kontentlar
@endsection

@section('content')
    <div class="container my-5">
        <h1 class="mb-5 text-center fw-bold text-white">📚 Useful Contents Hub</h1>

        <div class="container my-4">
            <form action="{{ route('home') }}" method="GET" class="d-flex justify-content-center" id="search-form">
                <input type="text" name="search" id="live-search" class="form-control w-50 me-2" placeholder="Kontent nomi yoki tavsifi bo‘yicha qidiruv..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Qidirish</button>
            </form>
        </div>

        @if($contents->count())
            <div class="row" id="content-list">
                @foreach($contents as $content)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow rounded-4 overflow-hidden">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $content->title }}</h5>

                                <p class="card-text small text-muted">
                                    {{ Str::limit($content->description, 100) }}
                                </p>

                                @if($content->authors && $content->authors->count())
                                    <p class="mt-2">
                                        <strong class="text-dark">Mualliflar:</strong><br>
                                        @foreach($content->authors as $author)
                                            <span class="badge bg-dark me-1 mb-1">{{ $author->name }}</span>
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

                                <div class="mt-3">
                                    @if(Str::contains($content->url, 'youtube'))
                                        <div class="ratio ratio-16x9 mb-3">
                                            <iframe src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    @elseif(Str::contains($content->url, 'spotify'))
                                        <div class="ratio ratio-1x1 mb-3">
                                            <iframe src="{{ $embedUrl }}" frameborder="0" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"></iframe>
                                        </div>
                                    @elseif(Str::contains($content->url, 't.me'))
                                        <a href="{{ $embedUrl }}" class="btn btn-info w-100 mb-3" target="_blank">Telegramga o'tish</a>
                                    @elseif(Str::contains($content->url, ['.jpg', '.jpeg', '.png', '.gif', '.webp']))
                                        <img src="{{ $content->url }}" class="img-fluid rounded mb-3" alt="Image">
                                    @elseif(Str::contains($content->url, ['.mp4', '.webm']))
                                        <video controls class="w-100 mb-3 rounded">
                                            <source src="{{ $content->url }}" type="video/mp4">
                                            Brauzeringiz video formatini qo‘llamaydi.
                                        </video>
                                    @else
                                        <a href="{{ $content->url }}" target="_blank" class="btn btn-outline-secondary w-100 mb-3">Manzilga o'tish</a>
                                    @endif
                                </div>

                                <div class="mt-auto">
                                    <a href="{{ route('contents.show', $content->id) }}" class="btn btn-outline-primary btn-sm w-100">Batafsil ko‘rish</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-muted">Hozircha hech qanday kontent mavjud emas.</p>
        @endif
    </div>
@endsection

@section('scripts')
<script>
document.getElementById('live-search').addEventListener('input', function () {
    let search = this.value;

    fetch(`/?search=${encodeURIComponent(search)}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest' // AJAX uchun so‘rov ekanligini bildiradi
        }
    })
    .then(response => response.text())
    .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newContent = doc.getElementById('content-list').innerHTML;
        document.getElementById('content-list').innerHTML = newContent;
    });
});
</script>
@endsection
