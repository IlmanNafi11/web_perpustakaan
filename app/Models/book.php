<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    /**
     * Daftar atribute yang dapat diisi melalui mass-assigment.
     * @var array
     */
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

    /**
     * Mendefinisikan relasi one to many dengan model MediaFile.
     * # Setiap buku memiliki banyak file media(cover dan file ebook)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mediaFiles()
    {
        return $this->hasMany(MediaFile::class);
    }
}
