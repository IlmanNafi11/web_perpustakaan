<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * Daftar atribute yang dapat diisi melalui mass-assigment.
     *
     * @var array
     */
    protected $fillable = [
        "nik",
        "pas_foto_path",
        "ktp_path",
        "user_id",
        "status",
        "attempt_count",
        "max_attempt",
        "is_locked",
        "last_attempt_at",
    ];

    /**
     * Mendefinisikan relasi one to one dengan model BorrowRequest
     * Setiap member memiliki satu permintaan peminjaman terkait.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<BorrowRequest, Member>
     */
    public function borrowRequests()
    {
        return $this->hasOne(BorrowRequest::class);
    }

    /**
     * Mendefinisikan relasi one to one dengan model User
     * Setiap member terkait dengan satu user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Member>
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
