<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Daftar atribute yang dapat diisi melalui mass-assigment.
     * @var array
     */
    protected $fillable = [
        "name",
    ];

    /**
     * Mendefinisikan relasi one to one dengan model Book.
     * # Setiap categori terkait dengan satu buku
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<Book, Category>
     */
    public function book()
    {
        return $this->hasOne(Book::class);
    }
}
