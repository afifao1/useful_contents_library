<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['title', 'description', 'url', 'category_id'];

    protected $with = ['category'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}

