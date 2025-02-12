<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    /**
     * Daftar atribute yang dapat diisi melalui mass-assigment.
     * @var array
     */
    protected $fillable = [
        "book_id",
        "media_type",
        "file_path",
        "file_type",
    ];

    /**
     * Mendefinisikan relasi many to one dengan model Book.
     * # Satu atau banyak media file terkait dengan satu data buku
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
