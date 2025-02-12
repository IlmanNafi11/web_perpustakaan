<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    /**
     * Note : Model UserNotification berlaku sebagai pivot table/jembatan antara model Users dengan Model Notification.
     * Hal ini disebabkan karena terjadinya relasi many to many antara model User dengan model Notification. 
     * 
     * @see App\Models\User
     * @see App\Models\Notification
     */


    /**
     * Daftar attribute yang dapat diisi melalui mass-assigment.
     * 
     * @var array
     */
    protected $fillable = [
        "user_id",
        "notification_id",
        "is_deleted",
        "is_read",
    ];
}
