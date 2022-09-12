<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Bailing extends Model
{
    use HasFactory;

    protected $fillable = [
        'Clean_Clear',
        'Green_Colour',
        'Others',
        'Trash'
    ];
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // public function bailed()
    // {
    //     $b = BailingItem::where('id',$this->bailingItem_id)->first();
    //     return $b->item;
    // }
    public function bailed(): string
    {
        $items = BailingItem::select('item')->pluck('item');
        $data = str_replace(" "," ",json_decode($items));

        for ($i=0; $i<count($items); $i++) { 
            $dataset[$data[$i]] = $data[$i];
        }
        return implode(", ",$data);
        
    }
}
