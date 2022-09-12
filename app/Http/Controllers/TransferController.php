<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer;
use App\Models\History;
use App\Models\BailedDetails;
use App\Models\SortDetails;
use App\Models\Total;
use App\Models\Factory;
use App\Models\BailingItem;
use App\Models\User;
use App\Models\Location;
use App\Models\TransferDetails;

use App\Models\Item;
use Auth;
use Carbon\Carbon;
use DB;
use App\Http\Traits\HistoryTrait;
use Illuminate\Support\Facades\Http;
use App\Models\TransferDetailsHistory;

class TransferController extends Controller
{
    //
    use HistoryTrait;

    public $successStatus = true;
    public $failedStatus = false;

    public function getTransfer(Request $request)
    {
        // $factory_id = Location::where('id',Auth::user()->location_id)->where('type','f')->first();
        $transfer = Transfer::with('factory','location')->where('location_id', Auth::user()->location_id)->get();
        $total = SortDetails::where('location_id',Auth::user()->location_id)->first();
        if(empty($total)){
            $transfered = 0;
        }else{
            
        $transfered = ($total->Clean_Clear ?? "0" + $total->Others ?? "0" + $total->Green_Colour ?? "0" + $total->Trash ?? "0" + $total->Caps ?? "0");
        }
        //dd($total);
        $bailed_details = BailedDetails::where('location_id',Auth::user()->location_id)->first();
        $sorted_details = SortDetails::where('location_id',Auth::user()->location_id)->first();
        $factory = Location::all();
        $collection = Location::all();
        $items = Item::all();
        $dateS = Carbon::now()->startOfMonth()->subMonth(3);
        $dateE = Carbon::now();
        $transfer_history = Transfer::with('factory','location','user')
                                ->where('location_id',Auth::user()->location_id)
                                ->orWhere('factory_id',Auth::user()->location_id)
                                ->whereBetween('created_at',[$dateS,$dateE])
                                ->get();
        $transfer_item = BailingItem::all();
        
        return response()->json([
            "status" => $this->successStatus,
            "bailed" => (string)$transfered ,
            "bailed_breakdown" => $bailed_details,
            "sorted_breakdown" => $sorted_details,
            "factory" => $factory,
            "collection_center" => $collection,
            "items" => $items,
            "transfer_item" => $transfer_item,
            "transfer_history"  => $transfer_history,

        ],200);
        
        
        return response()->json([
                "status" => $this->failedStatus,
                "message" => "No material available for transfer",
            ], 500);
    }
    public function getTransferHistory(Request $request)
    {
        $transfer = Transfer::with('factory','location')->where('location_id', Auth::user()->location_id)->get();
        $bailed_details = BailedDetails::where('location_id', Auth::user()->location_id)->get();
        $factory = Factory::all();
        return response()->json([
            "status" => $this->successStatus,
            "data" => $transfer
            
        ],200);
    }

    public function transfer(Request $request){
//dd($request->Clean_Clear["total_weight"]);
        try{
            $result = (($request->Clean_Clear["total_weight"] ?? 0) + ($request->Others["total_weight"] ?? 0) + ($request->Green_Colour["total_weight"] ?? 0) + ($request->Trash["total_weight"] ?? 0));
                $t = BailedDetails::where('location_id', Auth::user()->location_id)->first();
                $bailed = ($t->Clean_Clear + $t->Others + $t->Green_Colour + $t->Trash );
                if(empty($t)){
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'No Record Found',
                    ], 500);
                    
                }
                
                if( $t->location_id == $request->factory_id){
                        return response()->json([
                            'status' => $this->failedStatus,
                            'message'    => 'You can not transfer to this Location',
                        ], 500);                }
                    if($result > $bailed){
                        return response()->json([
                            'status' => $this->failedStatus,
                            'message'    => 'Insufficent Bailed Items',
                        ], 500);
                    }
                    $checkSort = BailedDetails::where('location_id', Auth::user()->location_id)->first();
                 if (empty($checkSort)) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'No Collection Found',
                    ],500 );
                 }
                if (($request->Clean_Clear["total_weight"] ?? 0)> $checkSort->Clean_Clear) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent Clean Clear Items',
                    ], 500);
                }elseif (($request->Green_Colour["total_weight"] ?? 0) > $checkSort->Green_Colour) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent  Green Colour Items',
                    ], 500);
                }elseif (($request->Others["total_weight"] ?? 0)> $checkSort->Others) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent Others Items',
                    ], 500);
                }elseif (($request->Trash["total_weight"] ?? 0) > $checkSort->Trash) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent Trash Items',
                    ], 500);
                }
                
         

                    $transfer = new Transfer();
                    $transfer->Clean_Clear = $request->Clean_Clear["total_weight"] ?? 0;
                    $transfer->Green_Colour = $request->Green_Colour["total_weight"] ?? 0;
                    $transfer->Others = $request->Others["total_weight"] ?? 0;
                    $transfer->Trash = $request->Trash["total_weight"] ?? 0;
                    $transfer->location_id = Auth::user()->location_id;
                    $transfer->factory_id = $request->factory_id;
                    
                    $transfer->clean_clear_qty = $request-> Clean_Clear["quantity"]?? 0;
                    $transfer->green_color_qty = $request->Green_Colour["quantity"]?? 0;
                    $transfer->other_qty = $request->Others["quantity"] ?? 0;
                    $transfer->trash_qty = $request->Trash["quantity"] ?? 0;

                    
                    $transfer->collection_id = Auth::user()->location_id;
                    $transfer->user_id = Auth::id();
                    $transfer->status = 0;
                    //dd($transfer);
                    $transfer->save();
    
    
                    $transfered = ($transfer->Clean_Clear + $transfer->Others + $transfer->Green_Colour + $transfer->Trash);
                    // $total = Total::where('location_id',Auth::user()->location_id)->first();
                    // $old_total_transfered = $total->transfered;
                    // $total->update(['transfered' => ($total->transfered + $transfered)]);
                    // $total->update(['bailed' => ($total->bailed - $transfered)]);
    
    
                    

                        $dataset = [
                        'Clean_Clear' => $request->Clean_Clear["total_weight"] ?? 0,
                        'Green_Colour' => $request->Green_Colour["total_weight"] ?? 0,
                        'Others' => $request->Others["total_weight"] ?? 0,
                        'Trash' => $request->Trash["total_weight"] ?? 0
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

    
                        $old_transfer = DB::table('transfer_details')->where('location_id', Auth::user()->location_id)->first();
                        
                        

                        if(empty($old_transfer)){
                            
                            DB::table('transfer_details')->insert([
                                array_merge($dataset, $other_value)
                            ]);

                        }else{
                            
                            //dd($new_dataset);
                            $updated = TransferDetails::where('location_id', Auth::user()->location_id)->first();
                           $updated->update(['Clean_Clear' => ($updated->Clean_Clear + ($request->Clean_Clear["total_weight"] ?? 0))]);
                           $updated->update(['Green_Colour' => ($updated->Green_Colour +($request->Green_Colour["total_weight"] ?? 0))]);
                           $updated->update(['Others' => ($updated->Others + ($request->Others["total_weight"] ?? 0))]);
                           $updated->update(['Trash' => ($updated->Trash + ($request->Trash["total_weight"] ?? 0))]);
                        }
                    
                    
                        $updated = BailedDetails::where('location_id', Auth::user()->location_id)->first();
                        //dd($updated->Clean_Clear);
                        $updated->update(['Clean_Clear' => ($updated->Clean_Clear - ($request->Clean_Clear["total_weight"] ?? 0))]);
                        $updated->update(['Green_Colour' => ($updated->Green_Colour - ($request->Green_Colour["total_weight"] ?? 0))]);
                        $updated->update(['Others' => ($updated->Others - ($request->Others["total_weight"] ?? 0))]);
                        $updated->update(['Trash' => ($updated->Trash - ($request->Trash["total_weight"] ?? 0))]);

                    
                    $notification_id = User::where('factory_id',$request->factory_id)
                        ->whereNotNull('device_id')
                        ->pluck('device_id');
                        //dd($notification_id);
                    if (!empty($notification_id)) {
                        
                        $factory = Factory::where('id',Auth::user()->location_id)->first();
                        $response = Http::withHeaders([
                            'Authorization' => 'key=AAAAva2Kaz0:APA91bHSiOJFPwd-9-2quGhhiyCU263oFWWrnYKtmuF1jGmDSMBHWiFkGy3tiaP3bLhJNMy9ki0YY061y5riGULckZtBkN9WkDZGX5X9HN60a2NvwHFR8Yevnat_zHzomC5O7AkdYwT8',
                            'Content-Type' => 'application/json'
                        ])->post('https://fcm.googleapis.com/fcm/send', [
                            "registration_ids" => $notification_id,
                                 "notification" => [
                                            "title" => "Transfer notification",
                                            "body" => "Incomming Transfer from ".$request->factory_id
                                        ]
                        ]);
                        $notification = $response->json('results');
                    }
                   
                   
                    return response()->json([
                        "status" => $this->successStatus,
                        "message" => "Transfer created successfull",
                        "data" => $transfer,
                        "total" => $t->transfered,
                        "total_bailed" => $t->bailed,
                        "notification" => $notification
                    ],200);
            
            } catch (Exception $e) {
                return response()->json([
                    'status' => $this->failedStatus,
                    'message'    => 'Error',
                    'errors' => $e->getMessage(),
                ], 500);
            }
        

    }
    public function updateTransfer(Request $request)
    {
        $transfer = Transfer::with('factory','location')
                    ->where('factory_id', Auth::user()->location_id)
                    ->where('id', $request->id)
                    ->first();
                    //dd($transfer);
        $transferupdate = Transfer::find($transfer->id);
        $transferupdate->status = $request->status;
        $transferupdate->rej_reason = $request->comments;
        $transferupdate->save();
        return response()->json([
            "status" => $this->successStatus,
            "message" => "Transfer updated successfull",
            "data" => $transfer
        ],200);
    }
    public function history(Request $request)
    {
        $history = History::all();
        return [
            "status" => $this->successStatus,
            "data" => $history
        ];
    }

   
}
