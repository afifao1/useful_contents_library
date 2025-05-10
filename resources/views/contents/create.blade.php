<style>
    label, select, option, input, textarea {
        color: white;
    }

    /* Background rang ham qoraroq bo‘lsa, yaxshi ko‘rinadi */
    input, textarea, select {
        background-color: #222;
        border: 1px solid #444;
    }

    .btn-success {
        background-color: green;
        color: white;
    }
</style>

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Yangi kontent qo‘shish</h2>

    <form method="POST" action="{{ route('contents.store') }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Sarlavha</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Tavsif</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="text" name="url" class="form-control">
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategoriya</label>
            <select name="category_id" class="form-select" required>
                <option value="">Tanlang</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="genre_id" class="form-label">Janrlar</label>
            <select name="genre_id[]" class="form-select" multiple>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
            <small class="text-muted">Bir nechta janr tanlashingiz mumkin (Ctrl bosib tanlang)</small>
        </div>

        <button type="submit" class="btn btn-success">Saqlash</button>
    </form>
</div>
@endsection
