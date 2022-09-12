<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Total extends Model
{
    use HasFactory;

    protected $fillable = [
        'collected',
        'sorted',
        'bailed',
        'transfered',
        'recycled',
        'sales',
         'location_id' 
    ];


    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
