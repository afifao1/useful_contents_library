<?php
declare(strict_types=1);

namespace App\Services\Contents;

use Illuminate\Support\Str;
use App\Models\Content as ContentModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Content
{

    private function convertToEmbedLink($url)
    {
        // 1. Agar link youtube.com/watch?v= bo‘lsa
        if (Str::contains($url, 'youtube.com/watch?v=')) {
            $videoId = explode('v=', $url)[1];
            $ampPos = strpos($videoId, '&');
            if ($ampPos !== false) {
                $videoId = substr($videoId, 0, $ampPos);
            }
            return "https://www.youtube.com/embed/" . $videoId;
        }

        // 2. Agar link youtu.be/ qisqa formatda bo‘lsa
        if (Str::contains($url, 'youtu.be/')) {
            $videoId = explode('youtu.be/', $url)[1];
            $questionMarkPos = strpos($videoId, '?');
            if ($questionMarkPos !== false) {
                $videoId = substr($videoId, 0, $questionMarkPos);
            }
            return "https://www.youtube.com/embed/" . $videoId;
        }

        return $url; // boshqa linklar o‘zgarmaydi
    }


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

    // Embedga o‘gir
    $validated['url'] = $this->convertToEmbedLink($validated['url']);

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

    $validated['url'] = $this->convertToEmbedLink($validated['url']);

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
