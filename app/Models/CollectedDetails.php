<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectedDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'collected',
        'location_id',
        'user_id'
    ];
    
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
