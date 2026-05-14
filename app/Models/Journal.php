<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = ['user_id', 'date', 'activity', 'photo_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
