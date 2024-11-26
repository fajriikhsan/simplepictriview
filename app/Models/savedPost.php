<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedPost extends Model
{
    protected $table = 'saved_posts';
    protected $primaryKey = 'id_save';

    protected $fillable = [
        'id_user',
        'id_post'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function upload()
    {
        return $this->belongsTo(Upload::class, 'id_post', 'id_post');
    }
}
