<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\StocksIn;
use App\Models\StocksOut;
use Barryvdh\DomPDF\Facade\PDF;

class StocksController extends Controller
{
    public function index(){
        $datas = Item::latest('updated_at')->paginate(10);
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
           $data = StocksIn::has('image', '=', 0)->select('int_no')->distinct()->orderBy('date', 'desc')->get();
        }else{
           $data = StocksOut::has('image', '=', 0)->select('int_no')->distinct()->orderBy('date', 'desc')->get();
        }
        return response()->json($data);
        
    }
    // Generate PDF
    public function createPDF() {
       $datas = Item::all();
       $pdf = PDF::loadView('inc.pdf', compact('datas'));
       return $pdf->download(date('Y-m-d-H-i-s').'.pdf');

      }
}
