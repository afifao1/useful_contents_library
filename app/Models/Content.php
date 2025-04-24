<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['title','description','url','category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}

