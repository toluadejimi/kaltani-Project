<?php

namespace App\Http\Controllers;

use App\Models\Sorting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\Collection;
use App\Models\CollectedDetails;
use DB;
use App\Http\Traits\HistoryTrait;
use Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\SortDetails;

use App\Models\BailingItem;
use App\Models\Item;
use Carbon\Carbon;

class SortingController extends Controller
{
    public $successStatus = true;
    public $failedStatus = false;

    use HistoryTrait;

    public function sorted(Request $request){
        try {
            
            $result = ($request->Clean_Clear ?? 0 + $request->Others ?? 0 + $request->Green_Colour ?? 0 + $request->Trash ?? 0);
            $t = CollectedDetails::where('location_id', Auth::user()->location_id)->first();
            if(empty($t)){
                return response()->json([
                    'status' => $this->failedStatus,
                    'message'    => 'No Collection Record Found',
                ],500 );
            }else{
$totals = CollectedDetails::where('location_id',Auth::user()->location_id)->first();
                if($result > $totals->collected){
                    return response()->json([
                        'status' => $this->failedStatus,
                        'message'    => 'Insufficent Collection',
                    ], 500);
                }
                
            }

                $sort = new Sorting();
                $sort->item_id = $request->item_id;
                $sort->Clean_Clear = $request->Clean_Clear ?? 0;
                $sort->Green_Colour = $request->Green_Colour ?? 0;
                $sort->Others = $request->Others ?? 0;
                $sort->Trash = $request->Trash ?? 0;
                $sort->Caps = $request->Caps ?? 0;
                $sort->location_id = Auth::user()->location_id;
                $sort->user_id = Auth::id();
                //dd($sort);
                $sort->save();
                
                
                //$sorted = ($sort->Clean_Clear + $sort->Others + $sort->Green_Colour + $sort->Trash);
                //dd($sorted);
                $sorted = ($sort->Clean_Clear + $sort->Others + $sort->Green_Colour + $sort->Trash);
                //dd($sorted);
                   
                $t = CollectedDetails::where('location_id',Auth::user()->location_id)->decrement('collected', $sorted);
                
                    

                $dataset = [
                'Clean_Clear' => $request->Clean_Clear ?? 0,
                'Green_Colour' => $request->Green_Colour ?? 0,
                'Others' => $request->Others ?? 0,
                'Trash' => $request->Trash ?? 0,
                'Caps' => $request->Caps ?? 0
                ];
                //dd($tweight);
                
                $other_value_history = [
                    
                    'location_id'=> Auth::user()->location_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                $other_value = [
                    'user_id' => Auth::id(),
                    'location_id'=> Auth::user()->location_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];

               
                $old_sorting = DB::table('sort_details')->where('location_id', Auth::user()->location_id)->first();

                if(empty($old_sorting)){
                    
                    DB::table('sort_details')->insert([
                        array_merge($dataset, $other_value)
                    ]);
                }else{
                    
                    //dd($new_dataset);
                    $updated = SortDetails::where('location_id', Auth::user()->location_id)->first();
                    $updated->update(['Clean_Clear' => ($updated->Clean_Clear + $request->Clean_Clear ?? 0)]);
                   $updated->update(['Green_Colour' => ($updated->Green_Colour + $request->Green_Colour ?? 0)]);
                   $updated->update(['Others' => ($updated->Others + $request->Others ?? 0)]);
                   $updated->update(['Trash'=> ($updated->Trash + $request->Trash ?? 0)]);
                   $updated->update(['Caps' => ($updated->Caps +$request->Caps ?? 0)]);
                               
                }
               

                

                return  response()->json([
                    "status" => $this->successStatus,
                    "message" => "Sorting created successfull",
                    "data" => $sort
                ],200);
            } catch (Exception $e) {
                return response()->json([
                    'status' => $this->failedStatus,
                    'message'    => 'Error',
                    'errors' => $e->getMessage(),
                ], 500);
            }
    }

    public function getSorted(Request $request)
    {
        //dd(Auth::user()->location_id);
        $getSorted = Sorting::with('item','location')->where('location_id', Auth::user()->location_id)->get();
        $sorting_items = BailingItem::all();
        $total = Collection::where('location_id',Auth::user()->location_id)->first();
        $totals = CollectedDetails::where('location_id',Auth::user()->location_id)->first();
        $items = Item::all();
        if(empty($getSorted))
        {
            return response()->json([
                "status" => $this->failedStatus,
                "message" => "No Record Found",
            ], 500);

        }else{
            if(isset($total)){
                return response()->json([
                "status" => $this->successStatus,
                "message" => "Successfull",
                "items" => $items,
                "sorting_items" => $sorting_items,
                "total_collected" => $totals->collected
            ], 200);
            }
            
             return response()->json([
                "status" => $this->failedStatus,
                "message" => "No material available for this center",
            ], 500);
            
        }
    }

    



    public function filter(Request $request)
    {
        $table_name = $request->input('table_name');
        $item = $request->input('item');
        $item_weight = $request->input('item_weight');
        $location = $request->input('location');
        $created_at = $request->input('created_at');
        $status = $request->input('status');
        $amount = $request->input('amount');

        $filter = DB::table('table_name')
            ->where('item', 'like', '%'.$item.'%')
            ->orWhere('item_weight', 'like', '%'.$item_weight.'%')
            ->orWhere('created_at', 'like', '%'.$created_at.'%')
            ->orWhere('status', 'like', '%'.$status.'%')
            ->orWhere('amount', 'like', '%'.$amount.'%')
            ->orWhere('userId', 'like', '%'.$userId.'%')
            ->get();
            return [
                "status" => $this->successStatus,
                "data" => $filter
            ];

    }
}
