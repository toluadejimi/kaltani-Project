<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
  
    public function totals()
    {
        return $this->hasMany(Total::class,'location_id');
    }

    public function collect()
    {
        return $this->hasMany(Collection::class);
    }

    public function factories()
    {
        return $this->hasMany(Transfer::class,'location_id');
    }
    
    
    
    public function collectionCenter()
    {
      return $this->hasOne(Location::class);
    }
}
