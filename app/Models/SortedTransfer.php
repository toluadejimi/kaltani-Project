<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortedTransfer extends Model
{
    use HasFactory;

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function tolocation()
    {

        return $this->belongsTo(Location::class,'toLocation','id');
    }

    public function formlocation()
    {

        return $this->belongsTo(Location::class,'formLocation','id');
    }
}
