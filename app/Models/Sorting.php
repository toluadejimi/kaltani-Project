<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Sorting extends Model
{
    use HasFactory;

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function bailingItem()
    {
        // $bailing = Sorting::all();
        // //dd($this->sorting_id);
        // return $this->sorting_id;
        return $this->belongsTo(BailingItem::class);
    }

    public function bail(): string
    {
        $items = BailingItem::select('item')->pluck('item');
        $data = str_replace(" "," ",json_decode($items));

        for ($i=0; $i<count($items); $i++) { 
            $dataset[$data[$i]] = $data[$i];
        }
        return implode(", ",$data);
        
    }

    public function sort(): string
    {
        $it = array();
        $items = DB::table('bailing_items')->whereIn('id',json_decode($this->sorting_id))->get();
       
        foreach($items as $t){
            $it[] = $t->item;
        }
        return implode(", ",$it);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

}
