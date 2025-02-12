<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * Daftar attribute yang dapat diisi melalui mass-assigment.
     * @var array
     */
    protected $fillable = [
        "message",
    ];

    /**
     * Mendefinisikan relasi many to many dengan model User.
     * Setiap Notifikasi dapat terkait dengan satu atau banyak user, begitu sebaliknya.
     * Note : 
     * 1. user_notifications adalah nama table pivot 
     * 2. is_deleted dan is_read adalah attribute tambahan pada table pivot. 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<User, Notification>
     */
    public function user()
    {
        return $this->belongsToMany(User::class, "user_notifications")->withPivot('is_deleted', 'is_read')->withTimestamps();
    }
}
