<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
<<<<<<< HEAD
    protected $fillable = ['title','description','url','category_id'];
=======
    protected $fillable = ['title', 'description', 'url', 'category_id'];

    protected $with = ['category'];
>>>>>>> ustoz/main

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
<<<<<<< HEAD

=======
>>>>>>> ustoz/main
