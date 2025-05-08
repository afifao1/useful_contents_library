@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Kontentni tahrirlash</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('contents.update', $content->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Sarlavha</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $content->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Tavsif</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $content->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="text" name="url" class="form-control" value="{{ old('url', $content->url) }}">
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategoriya</label>
            <select name="category_id" class="form-select" required>
                <option value="" disabled>Tanlang</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == old('category_id', $content->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="genre_id" class="form-label">Janrlar</label>
            <select name="genre_id[]" class="form-select" multiple>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}"
                        {{ in_array($genre->id, old('genre_id', $content->genres->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
            <div class="form-text">CTRL bosib turib bir nechta tanlashingiz mumkin</div>
        </div>

        <button type="submit" class="btn btn-success">Saqlash</button>
        <a href="{{ route('contents.index') }}" class="btn btn-secondary">Bekor qilish</a>
    </form>
</div>
@endsection
