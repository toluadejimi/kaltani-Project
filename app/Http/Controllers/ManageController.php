<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use App\Models\User;
use App\Models\Total;
use App\Models\History;
use App\Models\Location;
use App\Models\Collection;
use App\Models\Item;
use App\Models\Sales;
use App\Models\Factory;
use App\Models\Transfer;
use App\Models\TransferDetails;
use App\Models\BailingItem;
use App\Models\Sorting;
use App\Models\Bailing;
use App\Models\Recycle;
use App\Models\CollectedDetails;
use App\Models\UserRole;
use App\Models\FactoryTotal;
use App\Models\SortedTransfer;
use App\Models\SortDetailsHistory;
use App\Models\SortDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;
use Session;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Http\Traits\HistoryTrait;
use App\Models\BailedDetails;
use App\Models\BailedDetailsHistory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ManageController extends Controller
{
    //
    public function createRole(Request $request)
    {
        
            $role = new UserRole();
            $role->name = $request->input('name');
            $role->user_id = Auth::id();
            $role->save();

            return back()->with('message', 'Role Created Successfully'); 
    }
    public function roleList()
    {
        $role = UserRole::all();
        return view('manage/role',compact('role'));
    }
    public function roleEdit($id)
    {
        $role = UserRole::find($id);
        return view('manage/role_edit',compact('role'));
    }
    public function roleEditUpdate(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        return redirect('manage/role')->with('message', 'Role Updated Successfully');
    }
    public function roleDelete($id){
        $role = UserRole::find($id);
        $role->delete();
        return redirect('manage/role')->with('message', 'Role Deleted Successfully');
    }





    public function deleteCollection($id)
    {
        $items = Collection::find($id);
        CollectedDetails::where('location_id',$items->location_id)->decrement('collected', $items->item_weight);
        $items->delete();
        
        return back()->with('message', 'Deleted Successfully');
    }

    public function deleteSorting($id)
    {
        //delete sort_item
        $items = Sorting::find($id);
        $itemsSum = DB::table('sortings')
                            ->where('id',$id)
                            ->sum(\DB::raw('Clean_Clear + Green_Colour + Others + Trash'));
        $total = Total::where('location_id',$items->location_id)->first();

        // $old_total_collected = $total->collected;
        // $total->update(['collected' => ($total->collected + $itemsSum)]);
        // $total->update(['sorted' => ($total->sorted - $itemsSum)]);
        //dd($itemsSum);

        $updated = SortDetails::where('location_id', $items->location_id)->first();
        $updated->update(['Clean_Clear' => ($updated->Clean_Clear - $items->Clean_Clear)]);
        $updated->update(['Green_Colour' => ($updated->Green_Colour - $items->Green_Colour)]);
        $updated->update(['Others' => ($updated->Others - $items->Others)]);
        $updated->update(['Trash' => ($updated->Trash - $items->Trash)]);
        $items->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function deleteBailing($id)
    {
        //delete sort_item
        $items = Bailing::find($id);
        $itemsSum = DB::table('bailings')
                            ->where('id',$id)
                            ->sum(\DB::raw('Clean_Clear + Green_Colour + Others + Trash'));
        $total = Total::where('location_id',$items->location_id)->first();

        $old_total_collected = $total->collected;
        $total->update(['sorted' => ($total->sorted + $itemsSum)]);
        $total->update(['bailed' => ($total->bailed - $itemsSum)]);
        //dd($itemsSum);

        $updated = BailedDetails::where('location_id', $items->location_id)->first();
        $updated->update(['Clean_Clear' => ($updated->Clean_Clear - $items->Clean_Clear)]);
        $updated->update(['Green_Colour' => ($updated->Green_Colour - $items->Green_Colour)]);
        $updated->update(['Others' => ($updated->Others - $items->Others)]);
        $updated->update(['Trash' => ($updated->Trash - $items->Trash)]);
        $items->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function deleteTransfer($id)
    {
        //delete sort_item
        $items = Transfer::find($id);
        $itemsSum = DB::table('transfers')
                            ->where('id',$id)
                            ->sum(\DB::raw('Clean_Clear + Green_Colour + Others + Trash'));
        $total = Total::where('location_id',$items->location_id)->first();

        $old_total_collected = $total->collected;
        $total->update(['bailed' => ($total->bailed + $itemsSum)]);
        $total->update(['transfered' => ($total->transfered - $itemsSum)]);
        //dd($itemsSum);

        $updated = TransferDetails::where('location_id', $items->location_id)->first();
        $updated->update(['Clean_Clear' => ($updated->Clean_Clear - $items->Clean_Clear)]);
        $updated->update(['Green_Colour' => ($updated->Green_Colour - $items->Green_Colour)]);
        $updated->update(['Others' => ($updated->Others - $items->Others)]);
        $updated->update(['Trash' => ($updated->Trash - $items->Trash)]);
        $items->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function deleteRecycle($id)
    {
        //delete sort_item
        $items = Recycle::find($id);
       $rcy = Recycle::where('id',$id)->first();
       $trans = Transfer::where('factory_id',$items->factory_id)->first();
        if(FactoryTotal::where('factory_id',$items->factory_id)->exists()) {
            # code...
            $t = FactoryTotal::where('factory_id',$items->factory_id)->first();
            $t->update(['recycled' => ($t->recycled - $items->item_weight_input)]);
        }
        //dd($rcy,$trans,$items->item_weight_input);
        $total = Total::where('location_id',$trans->location_id)->first();
        $total->update(['transfered' => ($total->transfered + $items->item_weight_input)]);

        //$items->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function deleteSales($id)
    {
        //delete sort_item
        $items = Sales::find($id);
       //dd($items);
        if(FactoryTotal::where('factory_id',$items->factory_id)->exists()) {
            # code...
            $t = FactoryTotal::where('factory_id',$items->factory_id)->first();
            $t->update(['recycled' => ($t->recycled + $items->item_weight)]);
        }
 
        $items->delete();
        return back()->with('message', 'Deleted Successfully');
    }
    
    public function sortedTransferDeleted($id)
    {
            $sortedTransferDeleted = SortedTransfer::find($id);
           $updated = SortDetails::where('location_id', $sortedTransferDeleted->toLocation)->first();
            $updated->update(['Clean_Clear' => ($updated->Clean_Clear - $sortedTransferDeleted->Clean_Clear )]);
            $updated->update(['Green_Colour' => ($updated->Green_Colour - $sortedTransferDeleted->Green_Colour )]);
            $updated->update(['Others' => ($updated->Others - $sortedTransferDeleted->Others )]);
            $updated->update(['Trash' => ($updated->Trash - $sortedTransferDeleted->Trash )]);
            $updated->update(['Caps' => ($updated->Caps - $sortedTransferDeleted->Caps )]);



            $updated = SortDetails::where('location_id', $sortedTransferDeleted->formLocation)->first();
            $updated->update(['Clean_Clear' => ($updated->Clean_Clear + $sortedTransferDeleted->Clean_Clear )]);
            $updated->update(['Green_Colour' => ($updated->Green_Colour + $sortedTransferDeleted->Green_Colour )]);
            $updated->update(['Others' => ($updated->Others + $sortedTransferDeleted->Others )]);
            $updated->update(['Trash' => ($updated->Trash + $sortedTransferDeleted->Trash )]);
            $updated->update(['Caps' => ($updated->Caps + $sortedTransferDeleted->Caps )]);
            $sortedTransferDeleted->delete();
            return back()->with('message', 'Deleted Successfully');
    }

}
