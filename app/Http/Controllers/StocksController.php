<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StocksIn;
use App\Models\StocksOut;

class StocksController extends Controller
{
    public function index(){
        $datas = StocksIn::with('stocksOut')->orderBy('date', 'DESC')->paginate(10);
        $rank = $datas->firstItem();
        $items = \App\Models\StocksIn::all();
        return view('stocks.index',compact('datas', 'rank','items'));
    }
    public function search(Request $request){
        $datas = StocksIn::where('id', 'LIKE', $request->item_id)->orderBy('date', 'DESC')->paginate(10);
        $rank = $datas->firstItem();
        $items = \App\Models\StocksIn::all();
        return view('stocks.index',compact('datas', 'rank', 'items'));
    }
}
