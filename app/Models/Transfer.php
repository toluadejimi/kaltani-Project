<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Transfer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "from",
        "to",
        "item",
        "item_weight",
        "green_clear_qty",
        "status",
        "rej_reason",
        "user_id",
        ];
    
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function factory()
    {
        
        // $factory = Location::where('id',$this->factory_id)->where('type','f')->first();
        // //dd($factory->name);
        // return $factory->name;
        return $this->belongsTo(Location::class,'factory_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
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
