<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SortedTransfer;
use App\Models\SortDetails;
use App\Models\Total;
use Auth;

class SortedTransferController extends Controller
{
    public $successStatus = true;
    public $failedStatus = false;


    public function sortedTransfer(Request $request)
    {
        try {
            $result = ($request->Clean_Clear + $request->Others + $request->Green_Colour + $request->Trash + $request->Caps);
            
            $t = SortDetails::where('location_id', Auth::user()->location_id)->first();
            $sorted = ($t->Clean_Clear + $t->Others + $t->Green_Colour + $t->Trash + $t->Caps);
            if(empty($sorted)){
                return response()->json([
                    'status' => $this->failedStatus,
                    'message'    => 'No Collection Found',
                ],500 );
            }

                if($result > $sorted){
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
                }elseif ($request->Caps > $checkSort->Caps) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent Caps',
                    ], 500);
                }

            $sortedTransfer = new SortedTransfer();
            $sortedTransfer->item_id = $request->item_id;
            $sortedTransfer->Clean_Clear = $request->Clean_Clear ?? 0;
            $sortedTransfer->Green_Colour = $request->Green_Colour ?? 0;
            $sortedTransfer->Others = $request->Others ?? 0;
            $sortedTransfer->Trash = $request->Trash ?? 0;
            $sortedTransfer->Caps = $request->Caps ?? 0;
            $sortedTransfer->formLocation = Auth::user()->location_id;
            $sortedTransfer->toLocation = $request->toLocation ?? 0;
            $sortedTransfer->location_id = Auth::user()->location_id;
            $sortedTransfer->user_id = Auth::id();
            //dd($sortedTransfer);
            $sortedTransfer->save();
                
            
            $update = SortDetails::where('location_id', $request->toLocation)->first();
            if(empty($update)){
                $sortedTransfer = new SortDetails();
            $sortedTransfer->Clean_Clear = $request->Clean_Clear ?? 0;
            $sortedTransfer->Green_Colour = $request->Green_Colour ?? 0;
            $sortedTransfer->Others = $request->Others ?? 0;
            $sortedTransfer->Trash = $request->Trash ?? 0;
            $sortedTransfer->Caps = $request->Caps ?? 0;
            $sortedTransfer->location_id = $request->toLocation;
            $sortedTransfer->user_id = Auth::id();
            //dd($sortedTransfer);
            $sortedTransfer->save();
            }else{
                $updated = SortDetails::where('location_id', $request->toLocation)->first();
            $updated->update(['Clean_Clear' => ($updated->Clean_Clear + $request->Clean_Clear ?? 0)]);
            $updated->update(['Green_Colour' => ($updated->Green_Colour +$request->Green_Colour ?? 0)]);
            $updated->update(['Others' => ($updated->Others + $request->Others ?? 0)]);
            $updated->update(['Trash' => ($updated->Trash + $request->Trash ?? 0)]);
            $updated->update(['Caps' => ($updated->Caps + $request->Caps ?? 0)]);
            }



            $updated = SortDetails::where('location_id', Auth::user()->location_id)->first();
            $updated->update(['Clean_Clear' => ($updated->Clean_Clear - $request->Clean_Clear ?? 0)]);
            $updated->update(['Green_Colour' => ($updated->Green_Colour - $request->Green_Colour ?? 0)]);
            $updated->update(['Others' => ($updated->Others - $request->Others ?? 0)]);
            $updated->update(['Trash' => ($updated->Trash - $request->Trash ?? 0)]);
            $updated->update(['Caps' => ($updated->Caps - $request->Caps ?? 0)]);

            return  response()->json([
                "status" => $this->successStatus,
                "message" => "Successfull",
                "data" => $sortedTransfer
            ],200);

        } catch (Exception $e) {
            return response()->json([
                "status" => $this->failedStatus,
                "message" => $e,
            ], 500);
        }
    }
    
    public function transfer(Request $request){
        
        
        try{
            $result = ($request->Clean_Clear + $request->Others + $request->Green_Colour + $request->Trash);
                $t = SortDetails::where('location_id', Auth::user()->location_id)->first();
            $sorted = ($t->Clean_Clear + $t->Others + $t->Green_Colour + $t->Trash + $t->Caps);
                if(empty($sorted)){
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'No Record Found',
                    ], 500);
                    
                }
    
                    if($result > $sorted){
                        return response()->json([
                            'status' => $this->failedStatus,
                            'message'    => 'Insufficent Bailed Items',
                        ], 500);
                    }
                    $checkSort = SortDetails::where('location_id', Auth::user()->location_id)->first();
                 if (empty($checkSort)) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'No Collection Found',
                    ],500 );
                 }
                if ($request->Clean_Clear > $checkSort->Clean_Clear) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent Clean Clear Items',
                    ], 500);
                }elseif ($request->Green_Colour > $checkSort->Green_Colour) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent  Green Colour Items',
                    ], 500);
                }elseif ($request->Others > $checkSort->Others) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent Others Items',
                    ], 500);
                }elseif ($request->Trash > $checkSort->Trash) {
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent Trash Items',
                    ], 500);
                }
                

                    $transfer = new Transfer();
                    $transfer->Clean_Clear = $request->Clean_Clear ?? 0;
                    $transfer->Green_Colour = $request->Green_Colour ?? 0;
                    $transfer->Others = $request->Others ?? 0;
                    $transfer->Trash = $request->Trash ?? 0;
                    $transfer->Caps = $request->Caps ?? 0;
                    $transfer->location_id = Auth::user()->location_id;
                    $transfer->factory_id = $request->factory_id;
                    $transfer->collection_id = Auth::user()->location_id;
                    $transfer->user_id = Auth::id();
                    $transfer->status = 0;
                    //dd($transfer);
                    $transfer->save();
                    
    
                    $transfered = ($transfer->Clean_Clear + $transfer->Others + $transfer->Green_Colour + $transfer->Trash);
                    // $total = Total::where('location_id',Auth::user()->location_id)->first();
                    // $old_total_transfered = $total->transfered;
                    // $total->update(['transfered' => ($total->transfered + $transfered)]);
                    // $total->update(['sorted' => ($total->sorted - $transfered)]);
    
    
                    
                    
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
    
                        $old_transfer = DB::table('transfer_details')->where('location_id', Auth::user()->location_id)->first();

                        if(empty($old_transfer)){
                            
                            DB::table('transfer_details')->insert([
                                array_merge($dataset, $other_value)
                            ]);
                        }else{
                            
                            //dd($new_dataset);
                            $updated = TransferDetails::where('location_id', Auth::user()->location_id)->first();
                           $updated->update(['Clean_Clear' => ($updated->Clean_Clear + $request->Clean_Clear ?? 0)]);
                           $updated->update(['Green_Colour' => ($updated->Green_Colour +$request->Green_Colour ?? 0)]);
                           $updated->update(['Others' => ($updated->Others + $request->Others ?? 0)]);
                           $updated->update(['Trash' => ($updated->Trash + $request->Trash ?? 0)]);
                           $updated->update(['Caps' => ($updated->Caps + $request->Caps ?? 0)]);
                        }
                    
                        $updated = SortDetails::where('location_id', Auth::user()->location_id)->first();
                        //dd($updated->Clean_Clear);
                        $updated->update(['Clean_Clear' => ($updated->Clean_Clear - $request->Clean_Clear ?? 0)]);
                        $updated->update(['Green_Colour' => ($updated->Green_Colour - $request->Green_Colour ?? 0)]);
                        $updated->update(['Others' => ($updated->Others - $request->Others ?? 0)]);
                        $updated->update(['Trash' => ($updated->Trash - $request->Trash ?? 0)]);
                        $updated->update(['Caps' => ($updated->Caps - $request->Caps ?? 0)]);
    
                   
                    
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
                                            "body" => "Incomming Transfer from ".$factory->name
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
    
    public function getSortedTransfer()
    {
        $getsortedtransfer = SortedTransfer::where('location_id',Auth::user()->location_id)->get();
        return  response()->json([
                "status" => $this->successStatus,
                "message" => "Successfull",
                "data" => $getsortedtransfer
            ],200);
    }
}
