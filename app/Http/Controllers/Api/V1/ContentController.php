<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        return response()->json((new \App\Services\Contents\Content())->all());
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        return (new \App\Services\Contents\Content())->show($id);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
