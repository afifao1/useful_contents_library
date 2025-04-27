<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Content::all();
<<<<<<< HEAD

=======
>>>>>>> ustoz/main
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
<<<<<<< HEAD
        return Content::all();
=======
>>>>>>> ustoz/main
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $content = Content::query()->create([
<<<<<<< HEAD
            'title'       => ucfirst(fake()->words(rand(3,7),true)),
=======
            'title'       => ucfirst(fake()->words(rand(3,7), true)),
>>>>>>> ustoz/main
            'description' => fake()->realText('100'),
            'url'         => fake()->url,
            'category_id' => Category::query()->inRandomOrder()->value('id'),
        ]);
<<<<<<< HEAD
=======

>>>>>>> ustoz/main
        return $content;
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        //
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
}
