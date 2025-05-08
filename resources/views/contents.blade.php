<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Content Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<div class="container">
    @if (session('success'))
        <div class='alert alert-success'>
            {{session('success')}}
        </div>
        @endif
    <div class="row">
        @foreach($contents as $content)
            <div class="col-4 mb-3 p-3 mb-sm-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$content->title}}</h5>
                        <p class="card-text">{{$content->description}}</p>
                        <a href="/contents/{{$content->id}}" class="btn btn-primary">Open</a>
                    </div>
                    @dump($content->authors)
                </div>
            </div>
        @endforeach
    </div>

</div>
