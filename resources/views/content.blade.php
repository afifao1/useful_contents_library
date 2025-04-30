<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Content Hub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/categories">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contents">Contents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h1 class="mb-3">{{$content->title}}</h1>

    <p class="text-muted mb-4">
        {{$content->description}}
    </p>

    <div class="mb-4">
        <a href="{{$content->url}}" class="text-decoration-none">Visit Book Website</a>
    </div>

    <div class="mb-3">
        <h5 class="mb-2">Author</h5>
        @foreach($content->authors as $author)
            <span class="badge bg-primary">{{$author->name}}</span>
        @endforeach
    </div>

    <div class="mb-3">
        <h5 class="mb-2">Category</h5>
        <span class="badge bg-secondary">{{$content->category->name}}</span>
    </div>
    <div class="mb-3">
        <h5 class="mb-2">Genres</h5>
        @foreach($content->genres as $genre)
            <span class="badge bg-success">{{$genre->name}}</span>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
