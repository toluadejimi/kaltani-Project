<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateLga extends Model
{
    use HasFactory;

    protected $fillable = [
        'state',
        'lga'
    ];
    
    // public function location()
    // {
    //     return $this->belongsTo(Location::class);
    // }
}
