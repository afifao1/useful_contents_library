<?php
declare(strict_types=1);

namespace App\Services\Contents;

use App\Models\Content as ContentModel;

class Content
{
    public function all(){
    $contents = ContentModel::with('authors')->get();

    foreach($contents as $content){
        $content->title = strtoupper($content->title);
    }
        return $contents;
    }

    public function show(int $id){
        return ContentModel::query()->findOrFail($id);
    }

    public function authors(int $id){
        return ContentModel::query()->findOrFail($id)->authors;
    }
}
