<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Carousel extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'ownerName',
        'ceremonyType',
        'guestName',
        'guestMessage',
        'guestAttendance',
    ];
}
