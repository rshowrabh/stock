<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class StocksInController extends Controller
{
    protected $table = \App\Models\StocksIn::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $datas = $this->table::orderBy('date', 'DESC')->with('item')->paginate(10);
        $rank = $datas->firstItem();
        $items = \App\Models\Item::all();
        return view('stocks.in.index',compact('datas', 'rank', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $items = \App\Models\Item::latest()->get();
         return view('stocks.in.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required',
            'int_no' => 'required',
            'date' => 'required|date',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        $datas = \Auth::user()->stocksIn()->create($request->all());;
        return redirect()->route('stocks-in.index')->with('message', 'Stocks Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->table::find($id);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->table::find($id);
        $items = \App\Models\Item::latest()->get();
        return view('stocks.in.edit',compact('data', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $validated = $request->validate([
            'item_id' => 'required',
            'int_no' => 'required',
            'date' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);        
        $data=$this->table::findOrFail($id);
        $data->fill(['user_id' => \Auth::user()->id] + $request->all())->save();
        return redirect()->route('stocks-in.index')->with('message', 'Stocks Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->table::find($id);
        $post->delete();
        return redirect()->route('stocks-in.index')->with('message', 'Stocks Deleted');
    }

    public function search_name(Request $request){
        $datas = $this->table::where('item_id', 'LIKE', $request->item_id)->orderBy('date', 'DESC')->with('item')->paginate(10);
        $rank = $datas->firstItem();
        $items = \App\Models\Item::all();
        return view('stocks.in.index',compact('datas', 'rank', 'items'));
    }

    public function search_date(Request $request){

        $from = date($request->search_date_from);
        $to = date($request->search_date_to);
        $datas = $this->table::whereBetween('date', [$from, $to])->orderBy('date', 'DESC')->with('item')->paginate(10);
        $rank = $datas->firstItem();
        $items = \App\Models\Item::all();
        return view('stocks.in.index',compact('datas', 'rank', 'items'));
    }

    public function createPDF() {
        $datas = $this->table::all();
        $pdf = PDF::loadView('inc.pdf_in', compact('datas'));
        return $pdf->download(date('Y-m-d-H-i-s').'.pdf');
       }
    
}
