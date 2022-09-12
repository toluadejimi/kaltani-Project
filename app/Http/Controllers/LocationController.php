<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\User;
use App\Models\Total;
use Illuminate\Http\Response;
use Auth;

class LocationController extends Controller
{
    //
    public $successStatus = true;
    public $failedStatus = false;

    public function location(Request $request)
    {
        $location = new Location();
        $location->name = $request->input('name');
        $location->address = $request->input('address');
        $location->city = $request->input('city');
        $location->state = $request->input('state');
        $location->user_id = Auth::id();
        $location->save();

        $t = Location::latest()->first();
        //dd($t);
        $total = new Total();
        $total->locationId = $t->id;
        $total->save();

        return  response()->json([
            "status" => $this->successStatus,
            "message" => "Successfull",
            "data" => $location
        ],200);
    }
    public function getLocation(Request $request)
    {
        $user = User::where('id',Auth::id())->first();
        //dd($user->location);
        $location = Location::where('id', $user->location_id)->get();
        return  response()->json([
            "status" => $this->successStatus,
            "message" => "Successfull",
            "data" => $location
        ],200);
    }
}
