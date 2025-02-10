<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class LyricistModel extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $table = 'lyricist';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'cover',
        'profile',
        'about',
        'whatsapp',
        'facebook',
        'twitter',
        'instagram',
        'password',
        'created_at',
        'updated_at',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function nateRasuls()
{
    return $this->hasMany(NateRasul::class,'lyricist');
}
}
