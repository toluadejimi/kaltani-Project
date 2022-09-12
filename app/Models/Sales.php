<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "item_weight",
        "amount",
        "customer_name",
        "user_id"
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
