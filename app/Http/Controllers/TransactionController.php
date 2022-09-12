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
use App\Models\Rate;
use Illuminate\Http\Response;
use Exception;
use Auth;
use DB;
use Mail;
use Hash;

class TransactionController extends Controller
{
    //
    public $SuccessStatus = true;
    public $FailedStatus = false;



    public function get_rate(Request $request)
    {
        $rate = Rate::all();

        return response()->json([
            "status" => $this->SuccessStatus,
            "message" => "Successfull",
            "data" => $rate
        ],200);

    }

    public function get_all_transactions(Request $request)
    {
        try{
            $user_id = Auth::user()->id;
            $result = Transaction::where('user_id', $user_id)
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


    public function  get_banks(Request $request)
    {
        
        $country = "NG";
        
        $databody = array(
                 "country" => $country,
        );
        
        
        $body = json_encode($databody);
        $curl = curl_init();

        $key = env('FLW_SECRET_KEY');
        //"Authorization: $key",
        curl_setopt($curl, CURLOPT_URL, "https://api.flutterwave.com/v3/banks/$country");
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($curl, CURLOPT_ENCODING, '');
              curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
              curl_setopt($curl, CURLOPT_TIMEOUT, 0);
              curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
              curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
              curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Accept: application/json',
                        "Authorization: $key",
                      )
            );
        

                $var = curl_exec($curl);
                curl_close($curl);
                

                $var = json_decode($var);
                return response()->json(['status' => $this->SuccessStatus, 'message' => $var], 200);


    

                
        
        
    }


    public function fetch_account(Request $request)
    {
       
       $key = env('FLW_SECRET_KEY');

       $account_number = $request->input('account_number');
       $account_bank = $request->input('account_bank');

        
        $databody = array(
                 "account_number" =>$account_number,
                 "account_bank" => $account_bank,
        );
        
        
        $body = json_encode($databody);
        $curl = curl_init();

        $key = env('FLW_SECRET_KEY');
        //"Authorization: $key",
        curl_setopt($curl, CURLOPT_URL, 'https://api.flutterwave.com/v3/accounts/resolve');
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($curl, CURLOPT_ENCODING, '');
              curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
              curl_setopt($curl, CURLOPT_TIMEOUT, 0);
              curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
              curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
              curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Accept: application/json',
                        "Authorization: $key",
                      )
            );

                $var = curl_exec($curl);
                curl_close($curl);
                

                $var = json_decode($var);
                return response()->json(['status' => $this->SuccessStatus, 'message' => $var], 200);
        
    }


    public function  verify_pin(Request $request)
        {

                    $transfer_pin = $request->input('transfer_pin');
                    
                    $getpin = Auth()->user();
                    $user_pin = $getpin->pin;

                    if(Hash::check($transfer_pin, $user_pin)) {
                    
                        return response()->json([
                            "status" => $this->SuccessStatus,
                            "message" => "Pin Confrimed",
                        ],200);
                    }else{
                        return response()->json([
                                    "status" => $this->FailedStatus,
                                    "message" => "Incorrect Pin, Please try again",
                                ],500);
                    }

        }

public function  bank_transfer(Request $request)
{

    

    $key = env('FLW_SECRET_KEY');

    $user_id = Auth::user()->id;
    $account_number = Auth::user()->account_number;
    $account_bank = Auth::user()->bank_code;
    $amount = $request -> amount;
    $narration = "Debit";
    $currency = "NGN";

    $user_wallet = Auth::user()->wallet;


    if($user_wallet >= $amount){

        //update wallet
        $userwallet = Auth()->user();
        $useramount = $userwallet->wallet;
        $removemoney = (int)$useramount - (int)$amount;
        
        $update = User::where('id',  $user_id)
        ->update([ 'wallet' => $removemoney]);

        
       

         $databody = array(
                            "account_number" =>$account_number,
                            "account_bank" => $account_bank,
                            "amount" => $amount,
                            "amount" => $amount,
                            "narration" => $narration,
                            "currency" => $currency,
            
                    );
            
            
                    $body = json_encode($databody);
                    $curl = curl_init();
            
                    $key = env('FLW_SECRET_KEY');
                    //"Authorization: $key",
                    curl_setopt($curl, CURLOPT_URL, 'https://api.flutterwave.com/v3/transfers');
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_ENCODING, '');
                        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
                        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
                        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                    'Content-Type: application/json',
                                    'Accept: application/json',
                                    "Authorization: $key",
                                )
                        );
            
                            $var = curl_exec($curl);
                            curl_close($curl);


                            
            
                            $var = json_decode($var);

                        if($var->status == "success"){
                            
                            
                        

                             //create Debit transaction
                            $transaction = new Transaction();
                            $transaction->user_id = $user_id;
                            $transaction->reference = $var->data->reference;
                            $transaction->amount = $amount;
                            $transaction->type = 'Debit';
                            $transaction->trans_id = $var->data->id;
                            $transaction->save();
                            
                                 $receiveremail = Auth::user()->email;

                        
                        
                                    //send email
                                    $data = array(
                                        'fromsender' => 'noreply@kaltaniims.com', 'KALTANI',
                                        'subject' => "Withdwral",
                                        'toreceiver' => $receiveremail
                                        );
                        
                                        Mail::send('withdwral', $data, function($message) use ($data){
                                            $message->from($data['fromsender']);
                                            $message->to( $data['toreceiver'] );
                                            $message->subject($data['subject']);
                        
                                        });

                           
                            
                            
        
        $id = $var->data->id;
        

        $body = json_encode($databody);
        $curl = curl_init();
        
        $key = env('FLW_SECRET_KEY');
        //"Authorization: $key",
        curl_setopt($curl, CURLOPT_URL, "https://api.flutterwave.com/v3/transfers/$id");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_ENCODING, '');
            curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($curl, CURLOPT_TIMEOUT, 0);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Accept: application/json',
                        "Authorization: $key",
                    )
            );
        
                $var = curl_exec($curl);
                curl_close($curl);
        
        
                
        
                $var = json_decode($var);
        
            
        
        
                if($var->data->status == 'FAILED'){
                
                $userwallet = Auth()->user();
                $useramount = $userwallet->wallet;
                $refundmoney = (int)$useramount + (int)$var->data->amount;
                
                $update = User::where('id',  $user_id)
                ->update([ 'wallet' => $refundmoney]);
                }
        
                return response()->json([
                    "status" => $this->SuccessStatus,
                    "message1" => $var,
                    "message2" => "Please try again later",
                ],200);
          

                            
                        }
                        
                        return response()->json(['status' => $this->SuccessStatus, 'message' => $var], 200);

    }
        return response()->json([
                    "status" => $this->FailedStatus,
                    "message" => "Insufficient Balance",
                ],401);
} 





        public function  transaction_verify(Request $request)
        {
        
            $user_id = Auth::user()->id;
            $id = $request->id;
        
            $key = env('FLW_SECRET_KEY');
        
            
        
            $databody = array(
               
        
        );
        
        
        
        $body = json_encode($databody);
        $curl = curl_init();
        
        $key = env('FLW_SECRET_KEY');
        //"Authorization: $key",
        curl_setopt($curl, CURLOPT_URL, "https://api.flutterwave.com/v3/transfers/$id");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_ENCODING, '');
            curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($curl, CURLOPT_TIMEOUT, 0);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Accept: application/json',
                        "Authorization: $key",
                    )
            );
        
                $var = curl_exec($curl);
                curl_close($curl);
        
        
                
        
                $var = json_decode($var);
        
            
        
        
                if($var->data->status == 'FAILED'){
                
                $userwallet = Auth()->user();
                $useramount = $userwallet->wallet;
                $refundmoney = (int)$useramount + (int)$var->data->amount;
                
                $update = User::where('id',  $user_id)
                ->update([ 'wallet' => $refundmoney]);
                }
        
                return response()->json([
                    "status" => $this->SuccessStatus,
                    "message1" => $var,
                    "message2" => "Please try again later",
                ],200);
          



}



}