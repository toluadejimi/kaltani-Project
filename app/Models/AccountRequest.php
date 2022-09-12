<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_name',
        'account_name',
        'account_number',
        'created_at',
        'updated_at'
    ];
    
    
}
