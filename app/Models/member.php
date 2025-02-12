<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * Daftar atribute yang dapat diisi melalui mass-assigment.
     * @var array
     */
    protected $fillable = [
        "nik",
        "pas_foto_path",
        "ktp_path",
        "user_id",
    ];

    /**
     * Mendefinisikan relasi one to one dengan model BorrowRequest
     * # Setiap member memiliki satu permintaan peminjaman terkait.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<BorrowRequest, Member>
     */
    public function borrowRequest()
    {
        return $this->hasOne(BorrowRequest::class);
    }
}
