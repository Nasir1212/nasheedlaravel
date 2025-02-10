<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NateRasul extends Model
{
    use HasFactory;
    protected $table = 'nate_rasul';
    protected $fillable = [
        'title',
        'lyricist',
        'lyrics',
        'created_at',
        'updated_at',

    ];
    public function lyricist()
{
    return $this->belongsTo(LyricistModel::class);
}

public function video_link(){
    return $this->hasMany(VideoLink::class,'lyric_id');

}

}
