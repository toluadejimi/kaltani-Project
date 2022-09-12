<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BailingItem;
use App\Models\Item;
use App\Models\Total;
use Illuminate\Http\Response;
use Auth;

class ItemsController extends Controller
{
    public $successStatus = true;
    public $failedStatus = false;
    //
    public function bailingList(){
        $items = BailingItem::all();
        $t = Total::where('locationId',Auth::user()->location_id)->first();
        return response()->json([
            "status" => $this->successStatus,
            "message" => "Successfull",
            "data" => $items,
            "total_collected" => $t->collected
        ],200);
    }
    public function itemList()
    {
        $items = Item::all();
        return response()->json([
            "status" => $this->successStatus,
            "message" => "Successfull",
            "data" => $items
        ],200);
    }
}
