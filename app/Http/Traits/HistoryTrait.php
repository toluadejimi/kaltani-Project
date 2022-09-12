<?php

namespace App\Http\Traits;
use App\Models\History;
use App\Models\Total;

trait HistoryTrait {
    public function allHistory($locationId,$userId) {

        $t = Total::where('location_id',auth()->user()->location_id)->first();
        //dd($t);
        if($t == null){
            //$t = Location::latest()->first();
            //dd($t);
            $total = new Total();
            $total->locationId = auth()->user()->location_id;
            $total->save();
            
        }
        
        $history = new History();
        $history->collected = $t->collected ?? null;
        $history->sorted = $t->sorted ?? null;
        $history->sales = $t->sales ?? null;
        $history->location_id = $t->location_id;
        $history->user_id   = auth()->user()->id;
        $history->save();
    }
}