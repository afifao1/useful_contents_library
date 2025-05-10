<?php
declare(strict_types=1);

namespace App\Services\Contents;

use App\Models\Content as ContentModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Content
{
    public function all(): Collection
    {
        $contents = ContentModel::with(['authors', 'genres'])->get();

        foreach ($contents as $content) {
            $content->title = strtoupper($content->title);
        }

        return $contents;
    }

    public function show(int $id): ContentModel
    {
        return ContentModel::with(['authors', 'genres'])->findOrFail($id);
    }

    public function store(Request $request): ContentModel
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'url'         => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'genre_id'    => 'required|array',
        ]);

        $content = ContentModel::create($validated);
        $content->genres()->attach($request->get('genre_id'));

        return $content;
    }

    public function update(Request $request, int $id): ContentModel
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'url'         => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'genre_id'    => 'required|array',
        ]);

        $content = ContentModel::findOrFail($id);
        $content->update($validated);
        $content->genres()->sync($request->get('genre_id'));

        return $content;
    }

    public function destroy(int $id): bool
    {
        $content = ContentModel::findOrFail($id);
        $content->genres()->detach();
        return $content->delete();
    }
}
