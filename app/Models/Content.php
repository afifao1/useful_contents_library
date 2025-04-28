<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'url', 'category_id'];

    protected $with = ['category'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function authors()
    {
        return $this->belongsToMany(
            Author::class,
            'author_content', // pivot table name
            'content_id', // foreign key on the pivot table for this model
            'author_id', // foreign key on the pivot table for the related model
        );
    }

    /**
     * How to implement many to many relationship
     * TODO:
     *  1. Create tables with migrations
     *     - create authors table
     *     - create contents table
     *     - create a pivot (intermediate) table for the many-to-many relationship
     *  2. Define the relationship in the:
     *     - Content model (belongsToMany) belongsTo
     *     - Author model (belongsToMany) hasMany
     *  3. Use the relationship in your code
     */
}

