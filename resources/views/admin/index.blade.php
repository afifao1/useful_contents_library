><x-header/>

<div class="container">
<form action="/contents" method="post">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="text" name="title">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <div class="mb-3">
        <label for="url" class="form-label">Url</label>
        <input type="text" class="form-control" id="url" name="url">
    </div>

    <select class="form-select" name="category_id">
        <option value="0" selected>Open this select menu</option>
        @foreach($categories as $id => $name)
            <option value="{{$id}}">"{{$name}}"</option>>
        @endforeach
    </select>

    <select class="form-select" name="genre_id">
        <option value="0" selected>Open this select menu</option>
        @foreach($genres as $id => $name)
            <option value="{{$id}}">"{{$name}}"</option>>
        @endforeach
    </select>


    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

