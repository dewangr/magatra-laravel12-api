<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama_tamu',
        'ucapan'
    ];
    
}
