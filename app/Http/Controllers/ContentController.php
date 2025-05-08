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
    // return response()->json(['contents' => Content::all()]);

    $content = ((new \App\Services\Contents\Content())->all());

    return response()->json($content);
}

    public function create()
    {

    }
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
        // return redirect()->route('contents.show',$content);
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        // $content->load('authors','genres');
        // return view('content',compact ('content'));
        return response()->json([
            'content' => $content->load('authors', 'genres'),
        ]);
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
