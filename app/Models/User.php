<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use HasFactory;

    protected $fillable = [
        'full_name',
        'username',
        'password',
        'role'
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'username_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $primaryKey = 'id_user'; // Ubah ke nama kolom primer yang sesuai
    public $incrementing = true; // Ubah jika id_user adalah auto-increment
    protected $keyType = 'int';

    public function savedPosts()
    {
        return $this->hasMany(SavedPost::class);
    }

    public function profilePicture()
{
    return $this->hasOne(ProfilePicture::class, 'id_user');
}


}
