<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factory;
use Illuminate\Http\Response;


class FactoryController extends Controller
{
    //
    public $successStatus = true;
    public $failedStatus = false;

    public function factory(Request $request)
    {
        

        $factory = new Factory();
        $factory->name = $request->input('name');
        $factory->address = $request->input('address');
        $factory->city = $request->input('city');
        $factory->state = $request->input('state');
        $factory->user_id = Auth::id();
        $factory->save();


        return  response()->json([
            "status" => $this->successStatus,
            "message" => "Successfull",
            "data" => $factory
        ],200);
    }

    public function getFactory(Request $request)
    {
        $factory = Factory::where('user_id', Auth::id())->get();
        return  response()->json([
            "status" => $this->successStatus,
            "message" => "Successfull",
            "data" => $factory
        ],200);
    }
}
