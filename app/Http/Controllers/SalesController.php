<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\FactoryTotal;
use Auth;

class SalesController extends Controller
{
    //
    public $successStatus = true;
    public $failedStatus = false;

    public function getSales(Request $request)
    {
        $sales = Sales::where('user_id', Auth::id())->get();
        return [
            "status" => $this->successStatus,
            "message" => "Successfull",
            "data" => $sales
        ];
    }
    public function sales(Request $request){
        try{
            $sales = new Sales();
        $sales->item_weight = $request->item_weight ?? 0;
        $sales->price_per_tone = $request->price_per_tone ?? 0;
        $sales->freight = $request->freight ?? 0;
        if ($request->currency == "NGN") {
            $sales->amount_ngn = $request->amount ?? 0;
        }
        if($request->currency == "USD"){
            $sales->amount_usd = $request->amount ?? 0;
        }
        $sales->currency = $request->currency;
        $sales->factory_id = Auth::user()->location_id;
        $sales->user_id = Auth::id();
        $sales->location_id = Auth::user()->location_id;
        $sales->save();

        $sale = $request->amount;

        $sales_amount = $request->amount ?? 0;
        $weight = $request->item_weight ?? 0;
        $recycled = $request->item_weight_output ?? 0;

        $factory_id = Auth::user()->location_id;

        if (FactoryTotal::where('factory_id',$factory_id)->exists()) {
            # code...
            $t = FactoryTotal::where('factory_id',$factory_id)->first();
            $t->update(['sales' => ($t->sales + $sales_amount)]);
            $t->update(['recycled' => ($t->recycled - $weight)]);
        }else{
            $total = new  FactoryTotal();
            $total->sales = $sales_amount;
            $total->factory_id = Auth::user()->location_id;
            $total->save();
        }
        $t = FactoryTotal::where('factory_id',$factory_id)->first();

        return response()->json([
            "status" => $this->successStatus,
            "message" => "Sales record created successfull",
            "data" => $sales,
            "total" => $t->sales
        ],200);
        }catch (Exception $e) {
            return response()->json([
                'status' => $this->failedStatus,
                'message'    => 'Error',
                'errors' => $e->getMessage(),
            ], 401);
        }
        

    }
}
