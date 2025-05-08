<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Genre;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
{
    $contents = (new \App\Services\Contents\Content())->all();
    return view('contents.index', compact('contents'));
}

    public function create()
    {
        $categories = Category::all();
        $genres = Genre::all();

        return view('contents.create', compact('categories', 'genres'));    }

    public function store(Request $request)
    {
        $content = Content::query()->create([
            'title'       => request('title'),
            'description' => request('description'),
            'url'         => request('url'),
            'category_id' => request('category_id'),
        ]);


        $content->genres()->attach($request->get('genre_id'));

        return redirect('/contents')->with('success','Content created successfully');
    }

    public function show(Content $content)
    {
        $content->load('authors', 'genres');
        return view('contents.show', compact('content'));
    }

    public function edit(Content $content)
    {
        $categories = Category::all();
        $genres = Genre::all();

        return view('contents.edit', compact('content', 'categories', 'genres'));
    }

    public function update(Request $request, Content $content)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'url'         => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $content->update($validated);

        // Janrlar (genres)ni yangilash
        $content->genres()->sync($request->get('genre_id', []));

        return redirect()->route('contents.index')->with('success', 'Kontent yangilandi!');
    }

    public function destroy(Content $content)
    {
        $content->genres()->detach();

        // Kontentni o‘chirish
        $content->delete();

        return redirect()->route('contents.index')->with('success', 'Kontent o‘chirildi!');
    }

    public function adminIndex(){
        $categories = Category::all('id', 'name')->pluck('name', 'id')->toArray();
        $genres = Genre::all('id', 'name')->pluck('name', 'id')->toArray();
        return view('admin.index',compact('categories','genres'));
    }
}
