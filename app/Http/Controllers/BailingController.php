<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bailing;
use App\Models\Total;
use Illuminate\Http\Response;
use Auth;
use App\Models\BailingItem;
use App\Models\BailedDetails;
use App\Models\SortDetails;
use Carbon\Carbon;
use DB;
use App\Http\Traits\HistoryTrait;
use App\Models\Item;

class BailingController extends Controller
{
    //
    use HistoryTrait;
    public $successStatus = true;
    public $failedStatus = false;
    
    public function getBailing(Request $request)
    {
        
        $total = SortDetails::where('location_id', Auth::user()->location_id)->first();
        if(empty($total)){
             return response()->json([
                "status" => $this->failedStatus,
                "message" => "No material available for this center",
            ], 500);
        }
        $tsorted = ($total->Clean_Clear + $total->Others + $total->Green_Colour + $total->Trash);
        $bailing_items = BailingItem::all();
        $getBailing = Bailing::where('location_id', Auth::user()->location_id)->get();
        $sorted = SortDetails::where('location_id', Auth::user()->location_id)->first();
        $items = Item::all();
        
        if(isset($total)){
            return response()->json([
            "status" => $this->successStatus,
            "message" => "Bailing created successfull",
            "items" => $items,
            "sorted_breakdown" => $sorted,
            "bailing_item" => $bailing_items,
            "total_sorted" => (string)$tsorted
        ],200);  
        }
        
        return response()->json([
                "status" => $this->failedStatus,
                "message" => "No material available for this center",
            ], 500);
     
    }

    public function bailing(Request $request)
    {
          
        
        
        try {
            
            $Clean_Clear = $request->Clean_Clear;
            $Others = $request-> Others;
            $Green_Colour = $request-> Green_Colour;
            $Trash = $request-> Trash;
            
            $result = $Clean_Clear + $Others + $Green_Colour + $Trash;
           
            //$result = ($request-> Clean_Clear  + $request-> Others  + $request-> Green_Colour  + $request-> Trash );
            
          
            
            $total = SortDetails::where('location_id', Auth::user()->location_id)->first();
            $tsorted = ($total->Clean_Clear + $total->Others + $total->Green_Colour + $total->Trash);
            if(empty($total)){
                return response()->json([
                    'status' => $this->failedStatus,
                    'message'    => 'No Collection Found',
                ],500 );
            }

                if($result > $tsorted){
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent Sorted ',
                    ], 500);
                }
                $checkSort = SortDetails::where('location_id', Auth::user()->location_id)->first();
                 if (empty($checkSort)) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'No Collection Record Found',
                    ],500 );
                 }
                if ($request->Clean_Clear > $checkSort->Clean_Clear) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent Clean Clear',
                    ], 500);
                }elseif ($request->Green_Colour > $checkSort->Green_Colour) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent  Green Colour',
                    ], 500);
                }elseif ($request->Others > $checkSort->Others) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent Others',
                    ], 500);
                }elseif ($request->Trash > $checkSort->Trash) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent Trash',
                    ], 500);
                }
            

                $bailing = new Bailing();
                $bailing->item_id = $request->item_id;
                $bailing->Clean_Clear = $request->Clean_Clear ?? 0;
                $bailing->Green_Colour = $request->Green_Colour ?? 0;
                $bailing->Others = $request->Others ?? 0;
                $bailing->Trash = $request->Trash ?? 0;
                $bailing->location_id = Auth::user()->location_id;
                $bailing->user_id = Auth::id();
                //dd($bailing);
                $bailing->save();


                // $bailed = ($bailing->Clean_Clear + $bailing->Others + $bailing->Green_Colour + $bailing->Trash);
                // $total = Total::where('location_id',Auth::user()->location_id)->first();
                // $old_total_bailed = $total-> bailed;
                // $total->update(['bailed' => ($total->bailed + $bailed)]);
                // $total->update(['sorted' => ($total->sorted - $bailed)]);


                $dataset = [
                    'Clean_Clear' => $request->Clean_Clear ?? 0,
                    'Green_Colour' => $request->Green_Colour ?? 0,
                    'Others' => $request->Others ?? 0,
                    'Trash' => $request->Trash ?? 0
                    ];
                    //dd($tweight);
                    
                    $other_value_history = [
                        'location_id'=> Auth::user()->location_id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                    $other_value = [
                        'location_id'=> Auth::user()->location_id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];

               
                $old_bailing = DB::table('bailed_details')->where('location_id', Auth::user()->location_id)->first();
                //dd(empty($old_sorting));
                if(empty($old_bailing)){
                    
                    DB::table('bailed_details')->insert([
                        array_merge($dataset, $other_value)
                    ]);
                }else{
                    
                    $updated = BailedDetails::where('location_id', Auth::user()->location_id)->first();
                    //dd($updated->Clean_Clear);
                    $updated->update(['Clean_Clear' => ($updated->Clean_Clear + $request->Clean_Clear ?? 0)]);
                    $updated->update(['Green_Colour' => ($updated->Green_Colour +$request->Green_Colour ?? 0)]);
                    $updated->update(['Others' => ($updated->Others + $request->Others ?? 0)]);
                    $updated->update(['Trash' => ($updated->Trash + $request->Trash ?? 0)]);
                }

                    $updated = SortDetails::where('location_id', Auth::user()->location_id)->first();
                    //dd($updated->Clean_Clear);
                    $updated->update(['Clean_Clear' => ($updated->Clean_Clear - $request->Clean_Clear ?? 0)]);
                    $updated->update(['Green_Colour' => ($updated->Green_Colour - $request->Green_Colour?? 0)]);
                    $updated->update(['Others' => ($updated->Others - $request->Others ?? 0)]);
                    $updated->update(['Trash' => ($updated->Trash - $request->Trash ?? 0)]);
                
                $bailing_items = BailingItem::all();
                return response()->json([
                    "status" => $this->successStatus,
                    // "data" => $bailing,
                    // "total" => $t->bailed,
                    "message" => "Bailing created Successfull",
                    "bailing_item" => $bailing_items,
                    // "total_sorted" => $t->sorted
                ],200);

        } catch (Exception $e) {
            return response()->json([
                'status' => $this->failedStatus,
                'message'    => 'Error',
                'errors' => $e,
            ], 401);
        }
    }
}
