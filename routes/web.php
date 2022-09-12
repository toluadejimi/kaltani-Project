<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ManageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/', function () {
    return view('login');
});
Route::get('signin', [MainController::class,'signin']);


Route::get('update-password', [MainController::class,'update_password']);
Route::post('updatepassword', [MainController::class,'updatepassword']);



Route::group(['middleware' => ['adminAuth']], function()

{
    Route::get('logout', [MainController::class,'logout']);

    Route::get('/dashboard', [MainController::class,'dashboard']);
    
    //drop off
    Route::get('/drop-off', [MainController::class,'drop_offlist']);
    Route::delete('dropoffDelete/{id}', [MainController::class,'dropoffDelete']);
    
    
    //agent request
    Route::get('/agent-request', [MainController::class,'agent_request']);
    Route::get('/agent_request_update/{id}', [MainController::class,'agent_request_update']);
    
   //fund agent
   Route::get('/fund-agent', [MainController::class,'fund_agent']);
   
   
   
   
   
   //transaction
    Route::get('/transactions', [MainController::class,'transactions']);


    
    
    
    

    Route::get('/users', [MainController::class,'users']);
    Route::get('/customers', [MainController::class,'customers']);
    Route::get('/agents', [MainController::class,'agents']);
    Route::post('createUser', [MainController::class,'createUser']);
     Route::post('/userEdit/{id}', [MainController::class,'userEdit']);
    Route::get('/user_edit/{id}', [MainController::class,'user_edit']);
    Route::delete('userDelete/{id}', [MainController::class,'userDelete']);

    Route::get('/report', [MainController::class,'report']);

    Route::get('/sorting', [MainController::class,'sorting']);
    Route::post('sorted', [MainController::class,'sorted']);

    Route::post('testsorting', [MainController::class,'testsorting']);

    Route::get('viewSortingDetails/{id}', [MainController::class,  'viewsorting']);
    Route::delete('sortedDelete/{id}', [ManageController::class,'deleteSorting']);
    // Route::get('sortedEdit/{id}', [ManageController::class,'editSorting']);
    // Route::post('sortedEdit/{id}', [ManageController::class,'updateSorting']);
    
    Route::get('/sortedtransfer', [MainController::class,'sortedTransferView']);
    Route::post('sorted_transfers', [MainController::class,'sortedTransfer']);
    Route::delete('sortedTransferDeleted/{id}', [ManageController::class,'sortedTransferDeleted']);

    Route::get('/item', [MainController::class,'itemList']);
    Route::get('/item_edit/{id}', [MainController::class,'itemEdit']);
    Route::post('itemEdit/{id}', [MainController::class,'itemEditUpdate']);
    Route::post('createItem', [MainController::class,'createItem']);
    Route::delete('itemDelete/{id}', [MainController::class,'itemDelete']);

    Route::get('/manage/role', [ManageController::class,'roleList']);
    Route::get('/manage/role_edit/{id}', [ManageController::class,'roleEdit']);
    Route::post('roleEdit/{id}', [ManageController::class,'roleEditUpdate']);
    Route::post('createRole', [ManageController::class,'createRole']);
    Route::delete('roleDelete/{id}', [ManageController::class,'roleDelete']);

    Route::get('/bailing', [MainController::class,'bailing']);    
    Route::post('bailed', [MainController::class,'bailed']);

    Route::get('/addCollection', [MainController::class,'viewCollect']); 
    Route::get('/collectioncenter', [MainController::class,'collectionCenter']);
    Route::post('collect', [MainController::class,'collect']);
    Route::get('collectionsDetails/{id}', [MainController::class,  'viewcollection']);
    Route::get('collection_center_details/{id}', [MainController::class,  'viewcollectioncenter']);
    Route::delete('deleteCollection/{id}', [ManageController::class,'deleteCollection']);


    Route::get('/bailing_item', [MainController::class,'bailingList']);
    Route::post('createBailingItem', [MainController::class,'createBailingItem']);
    Route::get('/bailing_item_edit/{id}', [MainController::class,'bailedEdit']);
    Route::post('bailItemEdit/{id}', [MainController::class,'bailItemEditUpdate']);
    Route::delete('bailedDelete/{id}', [ManageController::class,'deleteBailing']);


    Route::get('/locations', [MainController::class,'locations']);
    Route::post('createLocation', [MainController::class,'location']);
    Route::get('factory_edit/{id}', [MainController::class,'factoryEdit']);
    Route::post('factoryUpdate/{id}', [MainController::class,'factoryUpdate']);
    Route::delete('factoryDelete/{id}', [MainController::class,'factoryDelete']);


    Route::get('/factory', [MainController::class,'factory']);
    Route::get('/viewFactory/{id}', [MainController::class,'viewfactory']);
    Route::post('/createFactory', [MainController::class,'createFactory']);

    Route::get('/transfer', [MainController::class,'transfering']);
    Route::post('transferd', [MainController::class,'transferd']);
    Route::delete('tranferDeleted/{id}', [ManageController::class,'deleteTransfer']);
    Route::get('viewTransfer/{id}', [MainController::class,  'viewtransfer']);

    Route::get('/recycle', [MainController::class,'recycled']);
    Route::post('addrecycle', [MainController::class,'recycle']);
    Route::delete('recycleDelete/{id}', [ManageController::class,'deleteRecycle']);

    Route::get('/sales', [MainController::class,'salesp']);
    Route::post('addsales', [MainController::class,'sales']);
    Route::delete('salesDelete/{id}', [ManageController::class,'deleteSales']);

    //filiter
    
    Route::get('collectionFilter', [MainController::class,'collectionFilter']);
    Route::get('collection_report', [MainController::class,'collection_filter']);

    Route::get('sortedFilter', [MainController::class,'sortedFilter']);
    Route::get('sorting_report', [MainController::class,'sorted_filter']);

    Route::get('bailedFilter', [MainController::class,'bailedFilter']);
    Route::get('bailed_report', [MainController::class,'bailed_filter']);

    Route::get('transferFilter', [MainController::class,'transferFilter']);
    Route::get('transfered_report', [MainController::class,'transfer_filter']);

    Route::get('recycleFilter', [MainController::class,'recycleFilter']);
    Route::get('recycled_report', [MainController::class,'recycle_filter']);

    Route::get('salesFilter', [MainController::class,'salesFilter']);
    Route::get('sales_report', [MainController::class,'sales_filter']);
    Route::get('salesbailed_report', [MainController::class,'salesbailed_filter']);
});
