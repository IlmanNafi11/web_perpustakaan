<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Daftar attribute yang dapat diisi melalui mass-assigment.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Mendefinisikan relasi one to one dengan model Member
     * Setiap user terkait dengan 0 atau 1 Member.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<Member, User>
     */
    public function members()
    {
        return $this->hasOne(Member::class);
    }

    /**
     * Mendefinisikan relasi many to many dengan model Notification.
     * Setiap User dapat terkait dengan satu atau banyak Notification, begitu sebaliknya.
     * Note :
     * 1. user_notifications adalah nama table pivot
     * 2. is_deleted dan is_read adalah attribute tambahan pada table pivot.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Notification, User>
     */
    public function notifications()
    {
        return $this->belongsToMany(Notification::class, "user_notifications")->withPivot("is_deleted", "is_read")->withTimestamps();
    }

}
