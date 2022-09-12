<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Customer;
use App\Models\AgentRequest;
use App\Models\AccountRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//use Tymon\JwtAuth\Facades\JwtAuth;
use Laravel\Passport\TokenRepository;
use Illuminate\Http\Response;
use Laravel\Passport\Passport;
use App\Models\AccessToken;
use Carbon\Carbon;
use DB;
use Mail;

class AuthCoontroller extends Controller
{
    public $successStatus = true;
    public $failedStatus = false;


    public function Login()
    {
        try {
            //Login to account

                $credentials = request(['email', 'password']);

                Passport::tokensExpireIn(Carbon::now()->addDays(3));
                Passport::refreshTokensExpireIn(Carbon::now()->addDays(3));

            if (! auth()->attempt($credentials)) {
                return response()->json([
                    'status'=>$this->failedStatus,
                    'message' => 'Invalid email or password'
                ], 500);
            }

            $token = auth()->user()->createToken('API Token')->accessToken;
        
        return response()->json([
            "status" => $this->successStatus,
            'message' => "login Successfully",
            'user' => auth()->user()->load(['location']), 
            'role' => auth()->user()->role->name,
            'token' => $token,
            'expiresIn' => Auth::guard('api')->check(),
        ],200);
        } catch (Exception $e) {
            return response()->json([
                'status' => $this->failedStatus,
                'message'    => 'Error',
                'errors' => $e->getMessage(),
            ], 401);
        }
    }


    public function logout()
    {
        auth()->logout();

        return response()->json(['status' => $this->successStatus,'message' => 'Successfully logged out'],200);
    }

    public function createNewToken($token){
        return response()->json(
            [
                'status' => $this->successStatus,
                'expiresIn' => auth('api')->factory()->getTTL()*60*60*3,
                'user'=> auth()->user(),
                'tokenType' =>'Bearer',
                'accessToken' => $token,
                
            ],200
            );
       
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|string',
            'location' => 'required|string',
            'role' => 'required|string',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if($validator->fails()){
            return response()->json(['status' => $this->failedStatus,$validator->errors()->toJson()], 400);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => Hash::make($request->password)]
                ));
                $token = $user->createToken('API Token')->accessToken;


        $deviceId = AccessToken::find(Auth::id());
        $deviceId->update(['device_id' => $request->device_id]);
        


        return response()->json([
            'status' => $this->successStatus,
            'message' => 'User successfully registered',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function refresh()
    {
        return $this->createToken(auth()->refresh());
    }

    public function deviceId(Request $request)
    {
        $deviceId = User::find(Auth::id());
        $deviceId->update(['device_id' => $request->device_id]);
        return response()->json([
            'status' => $this->successStatus,
            'message' => 'DeviceId Updated',
            'user'=> auth()->user(),
        ],200);
    }
    
     public function updateUser(Request $request)
    {
        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        //dd($userid);
        $users = User::find($userid);
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => $this->failedStatus, "message" => $validator->errors()->first());
        } else {
            try {
                if ((Hash::check(request('old_password'), $users->password)) == false) {
                    $arr = array("status" => $this->failedStatus, "message" => "Check your old password." );
                } else if ((Hash::check(request('new_password'), $users->password)) == true) {
                    $arr = array("status" => $this->failedStatus, "message" => "Please enter a password which is not similar then current password.");
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => $this->successStatus, "message" => "Password updated successfully.");
                }
            } catch (Exception $e) {
                if (isset($e->errorInfo[2])) {
                    $msg = $e->errorInfo[2];
                } else {
                    $msg = $e->getMessage();
                }
                $arr = array("status" => $this->failedStatus, "message" => $msg);
            }
        }
        return \Response::json($arr);
    }
    
    
    
    public function updatePin(Request $request)
    {
        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        //dd($userid);
        $users = User::find($userid);
        $rules = array(
            'old_pin' => 'required',
            'new_pin' => 'required|min:4',
            'confirm_pin' => 'required|same:new_pin',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => $this->failedStatus, "message" => $validator->errors()->first());
        } else {
            try {
                if ((Hash::check(request('old_pin'), $users->pin)) == false) {
                    $arr = array("status" => $this->failedStatus, "message" => "Check your old pin." );
                } else if ((Hash::check(request('new_pin'), $users->pin)) == true) {
                    $arr = array("status" => $this->failedStatus, "message" => "Please enter a pin which is not similar then current pin.");
                } else {
                    User::where('id', $userid)->update(['pin' => Hash::make($input['new_pin'])]);
                    $arr = array("status" => $this->successStatus, "message" => "Password updated successfully.");
                }
            } catch (Exception $e) {
                if (isset($e->errorInfo[2])) {
                    $msg = $e->errorInfo[2];
                } else {
                    $msg = $e->getMessage();
                }
                $arr = array("status" => $this->failedStatus, "message" => $msg);
            }
        }
        return \Response::json($arr);
    }
    
    
    public function customer_register(Request $request) {
        
        $get_role_id = UserRole::where('name', 'customer')
        ->first();;


        $receiveremail= $request->email;


        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|string',
            'address' => 'required|string',
            'lga' => 'required|string',
            'state' => 'required|string',
            'gender' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'account_name' => 'required|string',
            'pin' => 'required|string',
            'password' => 'required|string|min:6',
            
            

            
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => $this->failedStatus,
                $validator->errors()->toJson()
                ], 400);
        }
        
        
      
        
        
            $customer = new User();
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            //$user->image = $request->has('image') ? Helpers::upload('customer/', 'png', $request->file('image')) : null;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->lga = $request->lga;
            $customer->state = $request->state;
            $customer->gender = $request->gender;
            $customer->wallet = 0;
            $customer->bank_name = $request->bank_name;
            $customer->account_number = $request->account_number;
            $customer->account_name = $request->bank_name;
            $customer->bank_code = $request->bank_code;
            $customer->role_id = $get_role_id->id;
            $customer->pin = bcrypt($request->pin);
            $customer->password = bcrypt($request->password);
            $customer->save();

            $token = $customer->createToken('API Token')->accessToken;

            



            //send email
            $data = array(
                'fromsender' => 'noreply@kaltaniims.com', 'KALTANI',
                'subject' => "Account Creation",
                'toreceiver' => $receiveremail
                );

                Mail::send('welcome', $data, function($message) use ($data){
                    $message->from($data['fromsender']);
                    $message->to( $data['toreceiver'] );
                    $message->subject($data['subject']);
                });


            
            
            return response()->json([
            'status' => $this->successStatus,
            'message' => 'User Registration Successful',
            
            ], 200);


        
    }

    public function updateAccountDetails(Request $request)
    {
        $input = $request->all();

        $account = new AccountRequest ();
        $account-> account_number = $request -> account_number;
        $account-> account_name = $request -> account_name;
        $account-> bank_name = $request -> bank_name;
        $account-> bank_code = $request -> bank_code;
        $account-> user_id = Auth::id();
        $account->save();
        
        
        
         return response()->json([
            'status' => $this->successStatus,
            'message' => 'Your request has been sent successfuly',
            'data' => $account,
        ], 200);
        


    }
       

    public function agent_register(Request $request){

        $input = $request->all();
        
        $first_name = Auth::user()->first_name;
        $last_name = Auth::user()->last_name;
        
        $input = new AgentRequest();
        $input-> org_name = $request -> org_name;
        $input-> address = $request -> address;
        $input-> state = $request -> state;
        $input-> lga = $request -> lga;
        $input-> longitude = $request -> longitude;
        $input-> latitude = $request -> latitude;
        $input-> city = $request -> city;
        $input-> user_id = Auth::id();
        $input-> customer_name = $first_name." ".$last_name;
        $input-> phone = $request-> phone;
        $input->save ();

        return response()->json([
            'status' => $this->successStatus,
            'message' => 'Your request to become an agent has been successful, One of our agent will get back to you shortly',
            'data' => $input,
        ], 200);

    }
    
     public function agent_status(Request $request){

       $user_id = Auth::id();
       $check_status = AgentRequest::where('user_id', $user_id)
       ->first();
       
       $status = $check_status->status;

        return response()->json([
            'status' => $this->successStatus,
            'agent' => $status,
        ], 200);

    }
      public function get_user(Request $request){

        
        $user_id = Auth::id();
       
        
        $result= User::where('id',$user_id)
        -> first(); 

            $token = $request->bearerToken();

            return response()->json([
                'ststus' => $this->successStatus,
                'user' =>$result,
                'token' => $token,
            ]);


      

   
    } 
    
    
    
    
    
}








