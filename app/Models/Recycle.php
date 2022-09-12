<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recycle extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "item_weight_input",
        "item_weight_output",
        'Clean_Clear',
        'Green_Colour',
        'Others',
        'Trash',
        "costic_soda",
        "detergent",
        "factory_id",
        "user_id"
    ];
    public function factory()
    {
        return $this->belongsTo(Location::class, 'factory_id','id');
    }
}
