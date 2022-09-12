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

Route::get('/', function () {
    return view('login');
});
Route::get('signin', [MainController::class,'signin']);
Route::group(['middleware' => ['adminAuth']], function()
{
    Route::get('logout', [MainController::class,'logout']);

    Route::get('/dashboard', [MainController::class,'dashboard']);

    Route::get('/users', [MainController::class,'users']);
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
    Route::post('collect', [MainController::class,'collect']);
    Route::get('collectionDetails/{id}', [MainController::class,  'viewcollection']);
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
    Route::post('/createFactory', [MainController::class,'createFactory']);

    Route::get('/transfer', [MainController::class,'transfering']);
    Route::post('transferd', [MainController::class,'transferd']);
    Route::delete('tranferDeleted/{id}', [ManageController::class,'deleteTransfer']);

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
});
