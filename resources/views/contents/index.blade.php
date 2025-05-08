@extends('layouts.app')

@section('header')
    Barcha Kontentlar
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('contents.create') }}" class="btn btn-primary">+ Yangi Kontent</a>
    </div>

    <div class="row">
        @foreach($contents as $content)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">
                    <div class="card-body">
                        <h5 class="card-title">{{ $content->title }}</h5>
                        <p class="card-text">{{ Str::limit($content->description, 100) }}</p>
                        <a href="{{ route('contents.show', $content->id) }}" class="btn btn-sm btn-outline-primary">Batafsil</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
