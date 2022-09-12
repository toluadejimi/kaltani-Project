<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetails extends Model
{
    use HasFactory;
    
    

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    
    public function factory()
    {
        return $this->belongsTo(Location::class,'factory_id','id');
    }
}
