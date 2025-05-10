<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Contents\Content as ContentService;

class ContentController extends Controller
{

    public function index()
    {
        return response()->json((new ContentService())->all());
    }

    public function store(Request $request)
    {
        $content = (new ContentService())->store($request);
        return response()->json($content, 201);
    }

    public function show(string $id)
    {
        return response()->json((new ContentService())->show((int)$id));
    }

    public function getEditData(int $id): array
    {
        return [
            'content' => \App\Models\Content::findOrFail($id),
            'categories' => \App\Models\Category::all(),
            'genres' => \App\Models\Genre::all(),
        ];
    }
    
    public function update(Request $request, string $id)
    {
        $content = (new ContentService())->update($request, (int)$id);
        return response()->json($content);
    }

    public function destroy(string $id)
    {
        (new ContentService())->destroy((int)$id);
        return response()->json(['message' => 'Deleted successfully.']);
    }

}
