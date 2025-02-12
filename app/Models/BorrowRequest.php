<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowRequest extends Model
{
    /**
     * Daftar atribute yang dapat diisi melalui mass-assigment.
     * @var array
     */
    protected $fillable = [
        "book_id",
        "quantity",
        "member_id",
        "status",
        "request_at",
        "is_taken",
    ];

    /**
     * Mendefinisikan relasi one to one dengan model Member.
     * # Setiap permintaan peminjaman terkait dengan satu member.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Member, BorrowRequest>
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
