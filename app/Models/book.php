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
     * 
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
     * Setiap buku memiliki banyak file media(cover dan file ebook)
     * 
     * @return HasMany<MediaFile, Book>
     */
    public function mediaFiles()
    {
        return $this->hasMany(MediaFile::class);
    }

    /**
     * Mendefinisikan relasi one to one dengan model Category
     * Setiap buku memiliki satu kategori terkait.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Category, Book>
     */
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

}
