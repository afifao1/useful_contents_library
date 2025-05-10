<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Services\Contents\Content as ContentService;


class ContentController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $genres = Genre::all();

        return view('contents.create', compact('categories', 'genres'));
    }
    public function index()
    {
        $contents = (new ContentService())->all();
        return view('contents.index', compact('contents'));
    }

    public function store(Request $request)
    {
        (new ContentService())->store($request);
        return redirect('/contents')->with('success','Content created successfully');
    }

    public function show($id)
    {
        $content = (new ContentService())->show((int)$id);
        return view('contents.show', compact('content'));
    }

    public function edit($id)
    {
        $content = (new ContentService())->show((int)$id);
        $categories = Category::all();
        $genres = Genre::all();

        return view('contents.edit', compact('content', 'categories', 'genres'));
    }

    public function update(Request $request, $id)
    {
        (new ContentService())->update($request, (int)$id);
        return redirect()->route('contents.index')->with('success', 'Kontent yangilandi!');
    }

    public function destroy($id)
    {
        (new ContentService())->destroy((int)$id);
        return redirect()->route('contents.index')->with('success', 'Kontent o‘chirildi!');
    }
}
