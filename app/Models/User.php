<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',  // Add the fields you want to be mass assignable
        'last_name',
        'unique_key',
        'name',
        'user_name',
        'email',
        'password',
        'division',
        'designation',
        'role_id',
        'permission_id',
        'phone',
        'phone_code',
        'phone_iso'
    ];

    public function officeMemorandam()
    {
        return $this->hasMany(OfficeMemorandum::class, 'uploaded_by');
    }
   // protected $guarded = ['*'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
