<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'Clean_Clear',
        'Green_Colour',
        'Others',
        'Trash',
        'Caps'
    ];
}
