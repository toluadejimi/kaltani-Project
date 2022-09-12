<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DropOff;
use App\Models\Collection;
use App\Models\CollectedDetails;
use App\Models\Total;
use App\Models\Location;
use App\Models\StateLga;
use App\Models\State;
use App\Models\Rate;
use App\Models\PlasticWaste;
use App\Models\Transaction;
use Illuminate\Http\Response;
use Auth;
use DB;
use Mail;

class CollectionController extends Controller
{
    //
    public $SuccessStatus = true;
    public $FailedStatus = false;

    public function collect(Request $request)
    {


        $collect = new Collection();
        $collect->item_id = $request->input('item');
        $collect->item_weight = $request->input('item_weight') ?? 0;
        $collect->price_per_kg = $request->input('price_per_kg') ?? 0;
        $collect->transport = $request->input('transport') ?? 0;
        $collect->loader = $request->input('loader') ?? 0;
        $collect->others = $request->input('others') ?? 0;
        $collect->location_id = Auth::user()->location_id;
        $collect->amount = $request->input('amount') ?? 0;
        $collect->user_id = Auth::id();
        $collect->save();

        $collected = $request->input('item_weight') ?? 0;
            $locationId = Auth::user()->location_id;
            
            
        $t = CollectedDetails::where('location_id', Auth::user()->location_id)->first();
                if(empty($t)){
                    $sort = new CollectedDetails();
                    $sort->collected =  $request->input('item_weight') ?? 0;
                    $sort->location_id = Auth::user()->location_id;
                    $sort->user_id = Auth::id();
                    $sort->save();
                }else{
                    CollectedDetails::where('location_id',Auth::user()->location_id)->increment('collected', $collected);
                }
        

        return response()->json([
            "status" => $this->SuccessStatus,
            "message" => "Collection created successfull",
            "data" => $collect,
            "total" => $t->collected
        ],200);
    }

    

    public function getCollection(Request $request)
    {
        try{
            $collect = Collection::with('location','item')
            ->where('location_id', Auth::user()->location_id)
            ->get();
            
        return response()->json([
            "status" => $this->SuccessStatus,
            "message" => "Successfull",
            "data" => $collect
        ],200);
        }catch (Exception $e) {
            return response()->json([
                'status' => $this->failedStatus,
                'msg'    => 'Error',
                'errors' => $e->getMessage(),
            ], 401);
        }
        
    }
    
    
    
    public function get_plastic_waste(Request $request)
    {
        try{
            
            $rate = Rate::all();
            $plasticwaste = PlasticWaste::all();
            
        return response()->json([
            "status" => $this->SuccessStatus,
            "message" => "Successfull",
            "waste" => $plasticwaste,
            "rate" => $rate
            
        ],200);
        
        }catch (Exception $e) {
            return response()->json([
                'status' => $this->failedStatus,
                'msg'    => 'Error',
                'errors' => $e->getMessage(),
            ], 401);
        }
        
    }


//get all state
    public function all_state(Request $request)
    {
        try{
            $state = State::all();

            return response()->json([
            "status" => $this->SuccessStatus,
            "message" => "Successful",
            "data" => $state
             ],200);
        
        }catch (Exception $e) {
            return response()->json([
                'status' => $this->failedStatus,
                'msg'    => 'Error',
                'errors' => $e->getMessage(),
            ], 401);
        }
        
    }

    //get lga by state
    public function get_lga(Request $request)
    
    {

        $state = $request->all();

        try{

         
            $result = StateLga::where('state', $state)
            ->get();
           
            
        return response()->json([
            "status" => $this->SuccessStatus,
            "message" => "Successfull",
            "data" => $result
        ],200);
        
        }catch (Exception $e) {
            return response()->json([
                'status' => $this->failedStatus,
                'msg'    => 'Error',
                'errors' => $e->getMessage(),
            ], 401);
        }
        
    }


    public function drop_off(Request $request)
    {
        $weight_id = $request->weight;
        
        
        
        $collection_center_id = $request->collection_center;
        
        
        $sender_id = Auth::id();
        $receiver_id = $collection_center_id;
        
        //get collection_center(location)
        $get_location = Location::where('id',$collection_center_id)
        ->first();
        
        $location_name = $get_location->name;
        $location_address = $get_location->address;
        
        //get user address
        $address = Auth::user()->address;
        $state = Auth::user()->state;
        $lga = Auth::user()->lga;
        $city= Auth::user()->city;
        $long = Auth::user()->long;
        $lat = Auth::user()->lat;
        
        
        //get rate
        $get_rate = Rate::where('id', 1)->first();
        $rate = $get_rate->rate;
        
        //get weight
        $get_weight = PlasticWaste::where('id', $weight_id)
        ->first();
        
        $plastic_weight_name = $get_weight->name;
        $plastic_weight = $get_weight->weight;
        
        
        
        
        //calculate amount
        $amount = $rate * $plastic_weight;
        
        
        
        if($sender_id == $receiver_id){
            return response()->json([
                'status' => $this->FailedStatus,
                'msg'    => 'You cant send drop off to yourself'
                
            ], 500);
            
        }else{
        
        

        function generateRandomString($length = 6) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }


        $drop = new DropOff();
        $drop->order_id = generateRandomString();
        $drop->amount = $amount;
        $drop ->weight =$plastic_weight_name;
        $drop->city = $city;
        $drop->lat = $lat;
        $drop->long = $long;
        $drop->address = $address;
        $drop->lga = $lga;
        $drop->state = $state;
        $drop->sender_id = Auth::id();
        $drop->receiver_id = $collection_center_id;

        if($file = $request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'upload/customer' ;
            $request->image->move(public_path('upload/customer'),$fileName);
            $drop->image = $fileName ;
        }
        
        
        $drop->status = 0;
        $drop->collection_center = $location_name;
        $drop->user_id = Auth::id();
        $drop->customer = Auth::user()->first_name. " " .Auth::user()->last_name;
        $drop->waste_weight = $plastic_weight;
        $drop->save();

        $user_email = Auth()->user();
        $receiveremail = $user_email->email;

        //send email
        $data = array(
            'fromsender' => 'noreply@kaltaniims.com', 'KALTANI',
            'subject' => "New Drop Off",
            'toreceiver' => $receiveremail
            );

            Mail::send('dropoff', $data, function($message) use ($data){
                $message->from($data['fromsender']);
                $message->to( $data['toreceiver'] );
                $message->subject($data['subject']);

            });


    
        return response()->json([
            "status" => $this->SuccessStatus,
            "message" => "Collection created successfull",
            "data" => $drop,
        ],200);
        
        }
        
        
    }


    public function update_drop_off(Request $request)
    {


       
        $order_id = $request->order_id;
        $user_id = $request->user_id = Auth::id();
        
        $get_orderamount = DropOff::where('order_id',$order_id)
        ->first();
        
        $orderamount = $get_orderamount->amount;
        

        try{

            DropOff::where('order_id',  $order_id)
            ->update([
            'status' => 1
        ]);


        

        //create Credit transaction
        $transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->amount = $orderamount;
        $transaction->type = 'Credit';
        $transaction->save();

        //update wallet
        $userwallet = Auth()->user();
        $useramount = $userwallet->wallet;
        $addmoney = (int)$orderamount + (int)$useramount;


        User::where('id',  $user_id)
        ->update([
        'wallet' => $addmoney
    ]);

    $user_email = Auth()->user();
    $receiveremail = $user_email->email;


            //send email
            $data = array(
                'fromsender' => 'noreply@kaltaniims.com', 'KALTANI',
                'subject' => "Wallet Updated",
                'bodyMessage' => "This email is to let you know your wallet has been credited with $orderamount",
                'toreceiver' => $receiveremail
                );

                Mail::send('credit', $data, function($message) use ($data){
                    $message->from($data['fromsender']);
                    $message->to( $data['toreceiver'] );
                    $message->subject($data['subject']);

                });


        return response()->json([
            "status" => $this->SuccessStatus,
            "message" => "Successfully Updated $orderamount has been added to your wallet ",
        ],200);

            




        
        }catch (Exception $e) {
            return response()->json([
                'status' => $this->failedStatus,
                'msg'    => 'Error',
                'errors' => $e->getMessage(),
            ], 401);
        }
        
    }


   public function nearest_location(REQUEST $request){

    $state = Auth::user()->state;
    $lga = Auth::user()->lga;
    $city = Auth::user()->city;

    

    $location = Location::where([
        'state' => $state ,
        'lga' => $lga,
        'city' => $city
            ])->get();


            return response()->json([
                "status" => $this->SuccessStatus,
                "location" => $location,
            ],200);

   }


   public function location_by_state(REQUEST $request){

    $state = Auth::user()->state;

    $location = Location::where([
        'state' => $state
            ])->get();


            return response()->json([
                "status" => $this->SuccessStatus,
                "location" => $location,
            ],200);

   }

   public function location_by_lga(REQUEST $request){

    $lga= Auth::user()->lga;

    $location = Location::where([
        'lga' => $lga
            ])->get();


            return response()->json([
                "status" => $this->SuccessStatus,
                "location" => $location,
            ],200);

   }

   public function location_by_city(REQUEST $request){

    $city= Auth::user()->city;

    $location = Location::where([
        'city' => $city
            ])->get();


            return response()->json([
                "status" => $this->SuccessStatus,
                "location" => $location,
            ],200);

   }
   
    public function agent_waste_list(REQUEST $request){

    $id = Auth::user()->id;
    $get_user = User::where([
        'id' => $id,
        'user_type' => 'agent',
    ])->first();
    

    
    $drop_off = DropOff::where('receiver_id', $get_user->location_id)
    ->get();


            return response()->json([
                "status" => $this->SuccessStatus,
                "drop_off" => $drop_off,
            ],200);

   }
   
   
//   public function agent_waste_list_update(REQUEST $request){

//     $order_id = $request->all();

    
//     $update=DropOff::where('order_id',  $order_id)
//             ->update([
//             'status' => 1
//         ]);
    
//             return response()->json([
//                 "status" => $this->SuccessStatus,
//                 "message" => "Successfully Updated Order",
//                 "drop_off" => $updste,
//             ],200);

//   }



}


















