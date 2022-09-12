<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DropOff;
use App\Models\Collection;
use App\Models\CollectedDetails;
use App\Models\Total;
use App\Models\StateLga;
use App\Models\PlasticWaste;
use App\Models\Transaction;
use App\Models\Slider;
use App\Models\Rate;
use Illuminate\Http\Response;
use Auth;
use DB;
use Mail;
use Hash;

class SettingController extends Controller
{
    //
    public $SuccessStatus = true;
    public $FailedStatus = false;



    public function get_slider(Request $request)
    {
        $slider = Slider::all();

        return response()->json([
            "status" => $this->SuccessStatus,
            "message" => "Successfull",
            "data" => $slider
        ],200);

    }
}