<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasheedLove extends Model
{
    use HasFactory;

    protected $table = 'nasheed_loves'; // Table name

    protected $fillable = [
        'user_id',
        'nasheed_id',
        'created_at',
    ];

    public $timestamps = false; // Since 'created_at' has a default value in MySQL

    /**
     * Relationship: A love belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A love belongs to a nasheed (from nate_rasul table)
     */
    public function nasheed()
    {
        return $this->belongsTo(NateRasul::class, 'nate_rasul_id');
    }
}
