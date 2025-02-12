<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        "title",
        "author",
        "isbn",
        "description",
        "quantity",
        "available",
        "year",
        "publisher",
        "language",
        "type",
        "category_id",
    ];

    public function mediaFiles()
    {
        // return $this->hasMany();
    }
}
