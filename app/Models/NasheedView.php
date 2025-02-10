<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasheedView extends Model
{
    use HasFactory;

    protected $table = 'nasheed_views'; // Specify the table name

    protected $fillable = [
        'nasheed_id',
        'ip_address',
        'user_agent'
    ];

    /**
     * Relationship: A NasheedView belongs to a Nasheed (nate_rasul)
     */
    public function nasheed()
    {
        return $this->belongsTo(NateRasul::class, 'nasheed_id');
    }
}
