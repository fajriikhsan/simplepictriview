<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table = 'upload'; // Sesuaikan nama tabel di database
    protected $primaryKey = 'id_post';

    protected $fillable = [
        'id_user', 
        'file_post', 
        'judul_post', 
        'desk_post'
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function savedPosts() 
    {
        return $this->hasMany(SavedPost::class, 'id_post', 'id_post');
    }

}

