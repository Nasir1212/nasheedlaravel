<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLink extends Model
{
    use HasFactory;
    protected $table = 'video_link';
    protected $fillable = [
        'lyric_id', 
        'link', 
        'uploader_id', 
        'uploader_type', 
        'created_at', 
        'updated_at', 

    ];

}
