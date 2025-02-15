<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowRecord extends Model
{
    use HasFactory;

    /**
     * Daftar attribute yang dapat diisi melalui mass-assigment.
     *
     * @var array
     */
    protected $fillable = [
        "borrow_request_id",
        "borrow_at",
        "return_at",
        "due_date",
        "status",
    ];

    /**
     * Mendefinisikan relasi one to one dengan model BorrowRequest.
     * Setiap record/catatan peminjaman terkait dengan satu permintaan peminjaman.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<BorrowRequest, BorrowRecord>
     */
    public function borrowRequests()
    {
        return $this->belongsTo(BorrowRequest::class);
    }
}
