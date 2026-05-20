<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'user_id', 'kedisiplinan', 'tanggung_jawab', 'kerja_sama', 
        'kreativitas', 'kemampuan_beradaptasi', 'kualitas_hasil_kerja', 
        'penyusunan_laporan', 'average', 'predicate', 'comments', 'finished_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
