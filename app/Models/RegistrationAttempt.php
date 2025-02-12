<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationAttempt extends Model
{
    /**
     * Daftar attribute yang dapat diisi melalui mass-assigment.
     * 
     * @var array
     */
    protected $fillable = [
        "user_id",
        "status",
        "attempt_count",
        "max_attempt",
        "is_locked",
        "last_attempt_at",
    ];

    /**
     * Mendefinisikan relasi one to one dengan model User.
     * Setiap entry registration attempt terkait dengan satu User.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, RegistrationAttempt>
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
