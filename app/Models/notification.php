<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        "message",
    ];

    /**
     * Mendifinisikan relasi one to one dengan model UserNotification
     * # Pada dasarnya model Notification memiliki relasi many to many dengan model User, model UserNotification berlaku sebagai pivot table/jembatan
     * antara model Notification dengan model User.
     * # Setiap notification 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<UserNotification, Notification>
     */
    public function userNotification()
    {
        return $this->hasOne(UserNotification::class);
    }
}
