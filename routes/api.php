<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthCoontroller;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\SortingController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\BailingController;
use App\Http\Controllers\RecycleController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SortedTransferController;
use App\Http\Controllers\TransactionController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum', 'access')->get('/user', function (Request $request) {
    return $request->user();
});
//users
Route::post('createUser', [AuthCoontroller::class, 'register']);
Route::post('updatepassword', [AuthCoontroller::class,'updateUser']);
Route::post('login', [AuthCoontroller::class, 'login']);
Route::group(['middleware' => ['auth:api','access']], function(){

//create and get collection
Route::post('collection', [CollectionController::class, 'collect']);
Route::get('getCollection', [CollectionController::class, 'getCollection']);


//create and get sorting
Route::post('sorting', [SortingController::class, 'sorted']);
Route::get('getSorting', [SortingController::class, 'getSorted']);

//create and get sorting
Route::post('sortingtransfer', [SortedTransferController::class, 'sortedTransfer']);
Route::get('getsortingtransfer', [SortedTransferController::class, 'getSortedTransfer']);

//create and get location
Route::post('location', [LocationController::class, 'location']);
Route::get('getLocation', [LocationController::class, 'getLocation']);
Route::get('getfactory', [LocationController::class, 'getfactory']);



//create and get bailing
Route::post('bailing', [BailingController::class, 'bailing']);
Route::get('getBailing', [BailingController::class, 'getBailing']);





//create and get factory
Route::post('factory', [FactoryController::class, 'factory']);
Route::get('getFactory', [FactoryController::class, 'getFactory']);


//create, get and update  transfer
Route::post('transfer', [TransferController::class, 'transfer']);
Route::get('getTransfer', [TransferController::class, 'getTransfer']);
Route::post('updateTransfer', [TransferController::class, 'updateTransfer']);

//get history
Route::get('getHistory', [TransferController::class, 'history']);

//get all items
Route::get('bailingList', [ItemsController::class, 'bailingList']);
Route::get('itemList', [ItemsController::class, 'itemList']);


//create and get sales
Route::post('sales', [SalesController::class, 'sales']);
Route::get('getSales', [SalesController::class, 'getSales']);
Route::post('getsalesbrakedown', [SalesController::class, 'getSalesbrakedown']);
Route::post('saleBailed', [SalesController::class, 'saleBailed']);


//create and get recycle
Route::post('recycle', [RecycleController::class, 'recycle']);
Route::get('getRecycle', [RecycleController::class, 'getRecycle']);

Route::post('deviceId', [AuthCoontroller::class, 'deviceId']);




});


//create customer 

Route::post('customer-register', [AuthCoontroller::class, 'customer_register']);
Route::get('get-banks', [TransactionController::class, 'get_banks']);
Route::get('all-state', [CollectionController::class, 'all_state']);
Route::post('get-lga', [CollectionController::class, 'get_lga']);
Route::post('fetch-account', [TransactionController::class, 'fetch_account']);







Route::post('customer-login', [AuthCoontroller::class, 'customer_login']);








//customer operations

Route::group(['middleware' => ['auth:api','access']], function(){
    
    Route::post('drop-off', [CollectionController::class, 'drop_off']);

    //customer drop off
    Route::get('get-plastic-waste', [CollectionController::class, 'get_plastic_waste']);
    Route::post('update-dropoff', [CollectionController::class, 'update_drop_off']);
    Route::post('nearest-location', [CollectionController::class, 'nearest_location']);
    Route::post('get-location-by-state', [CollectionController::class, 'location_by_state']);
    Route::post('get-location-by-city', [CollectionController::class, 'location_by_city']);
    Route::post('get-location-by-lga', [CollectionController::class, 'location_by_lga']);


    


    //customer transactions
    Route::post('get-all-transacction', [TransactionController::class, 'get_all_transactions']);
    Route::post('bank-transfer', [TransactionController::class, 'bank_transfer']);
    Route::post('transaction-verify', [TransactionController::class, 'transaction_verify']);

    

    Route::get('get-rate', [TransactionController::class, 'get_rate']);


    // customer profile
    Route::post('verify-pin', [TransactionController::class, 'verify_pin']);
    Route::post('update-password', [AuthCoontroller::class,'updateUser']);
    Route::post('update-pin', [AuthCoontroller::class,'updatePin']);
    Route::post('update-account', [AuthCoontroller::class,'updateAccountDetails']);

    // customer settings
    Route::get('get-slider', [SettingController::class, 'get_slider']);


    ///Agent 
    Route::post('agent-register', [AuthCoontroller::class, 'agent_register']);
    Route::post('agent-status', [AuthCoontroller::class, 'agent_status']);
    
    Route::post('get-user', [AuthCoontroller::class, 'get_user']);
    Route::post('agent-waste-list', [CollectionController::class, 'agent_waste_list']);
    Route::post('agent-waste-list-update', [CollectionController::class, 'agent_waste_list_update']);



    



    



    


 });





