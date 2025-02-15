<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowRequest extends Model
{
    use HasFactory;
    
    /**
     * Daftar atribute yang dapat diisi melalui mass-assigment.
     *
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
     * Setiap permintaan peminjaman terkait dengan satu member.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Member, BorrowRequest>
     */
    public function members()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Mendefinisikan relasi one to one dengan model BorrowRecord.
     * Setiap permintaan peminjaman yang berhasil(approved) terkait dengan satu entry di model BorrowRecord.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<BorrowRecord, BorrowRequest>
     */
    public function borrowRecords()
    {
        return $this->hasOne(BorrowRecord::class);
    }
}
