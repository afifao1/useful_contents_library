<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Genre;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = Content::all();

        return view('contents', ['contents' => $contents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $content = Content::query()->create([
            'title'       => request('title'),
            'description' => request('description'),
            'url'         => request('url'),
            'category_id' => request('category_id'),
        ]);

        $content->genres()->attach(request($request->get('genre_id')));
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        $content->load('authors');
        return view('content', ['content' => $content]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        //
    }

    public function adminIndex(){
        $categories = Category::all('id', 'name')->pluck('name', 'id')->toArray();
        $genres = Genre::all('id', 'name')->pluck('name', 'id')->toArray();
        return view('admin.index',compact('categories','genres'));
    }
}
