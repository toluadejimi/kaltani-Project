<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recycle;
Use App\Models\FactoryTotal;
use Auth;


class RecycleController extends Controller
{
    //
    public $successStatus = true;
    public $failedStatus = false;

    public function getRecycle(Request $request)
    {
        $recycle = Recycle::where('user_id', Auth::id())->get();
        return [
            "status" => $this->successStatus,
            "message" => "Successfull",
            "data" => $recycle
        ];
    }

    public function recycle(Request $request){
        $recycle = Recycle::create([
            "item_weight_input" => $request->item_weight_input,
            "costic_soda" => $request->costic_soda,
            "detergent" => $request->detergent,
            "item_weight_output" => $request->item_weight_output,
            "location_id"    => Auth::user()->location_id,
            "factory_id"    => Auth::user()->location_id,
            "user_id" => Auth::id(),
            
        ]);

        $recycled = $request->item_weight_output;

        $locationId = Auth::user()->location_id;
            
        if (FactoryTotal::where('factory_id',$locationId)->exists()) {
            # code...
            $t = FactoryTotal::where('factory_id',$locationId)->first();
            $t->update(['recycled' => ($t->recycled + $recycled)]);
        }else{
            $total = new  FactoryTotal();
            $total->recycled = $recycled;
            $total->factory_id = Auth::user()->location_id;
            $total->save();
        }
    $t = FactoryTotal::where('factory_id',$locationId)->first();
        return [
            "status" => $this->successStatus,
            "message" => "Recycle record created successfully",
            "data" => $recycle,
            "total" => $t->recycled
        ];

    }
}
