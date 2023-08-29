<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\StocksIn;
use App\Models\StocksOut;

class StocksController extends Controller
{
    public function index(){
        $datas = Item::paginate(10);
        $items = Item::all();
        $rank = $datas->firstItem();
        return view('stocks.index',compact('rank','datas','items'));
    }
    public function search(Request $request){
        $datas = Item::where('id', 'LIKE', $request->item_id)->paginate(10);
        $rank = $datas->firstItem();
        $items = Item::all();
        return view('stocks.index',compact('datas', 'rank', 'items'));
    }
    public function getInt(Request $request){
        if($request->type == 'in'){
           $data = StocksIn::has('image', '=', 0)->select('int_no')->orderBy('date', 'desc')->get();
        }else{
           $data = StocksOut::has('image', '=', 0)->select('int_no')->orderBy('date', 'desc')->get();
        }
        return response()->json($data);
        
    }
}
