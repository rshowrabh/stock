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
        
        $datas = $this->table::orderBy('date', 'DESC')->with('item')->paginate();
        $rank = $datas->firstItem();
        return view('stocks.in.index',compact('datas', 'rank',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('stocks.in.create');
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
        $datas = $this->table::where('item_id', 'LIKE', $request->item_id)->orderBy('date', 'DESC')->with('item')->paginate()->withQueryString();
        $rank = $datas->firstItem();
        return view('stocks.in.index',compact('datas', 'rank',));
    }
    public function search_name_int(Request $request){
        $datas = $this->table::where('int_no', 'LIKE', $request->int_no)->orderBy('date', 'DESC')->with('item')->paginate()->withQueryString();
        $rank = $datas->firstItem();
        return view('stocks.in.index',compact('datas', 'rank'));
    }

    public function search_date(Request $request){

        $from = date($request->search_date_from);
        $to = date($request->search_date_to);
        $datas = $this->table::whereBetween('date', [$from, $to])->orderBy('date', 'DESC')->with('item')->paginate()->withQueryString();
        $rank = $datas->firstItem();
        return view('stocks.in.index',compact('datas', 'rank'));
    }

    public function createPDF() {
        $datas = $this->table::orderBy("date", "desc")->get();
        $pdf = PDF::loadView('inc.pdf_in', compact('datas'));
        return $pdf->download(date('Y-m-d-H-i-s').'.pdf');
       }
    
    public function multiple_in(){
        $datas = $this->table::orderBy('date', 'DESC')->with('item')->paginate();
        $rank = $datas->firstItem();
        return view('stocks.in.multiple',compact('datas', 'rank'));
    }
    public function multiple_in_store(Request $request){  
        foreach ($request->item_id as $index => $unit) {
            $units[] = [
        'int_no' =>  $request->input('int_no'),
        'date' =>  $request->input('date'),
        'item_id' =>  $request->input('item_id')[$index],
        'quantity' =>  $request->input('quantity')[$index],
        'price' =>  $request->input('price')[$index],
        'comment' =>  $request->input('comment')[$index],
        'user_id' => \Auth::id(),
            ];
        }
        $created = \Auth::user()->stocksIn()->insert($units);
        if ($request->file('name')) {
            $filenameWithExt = $request->file('name')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME); 
        $extension =  $request->file('name')->getClientOriginalExtension(); 
        $filenameToStore = $filename.'-'.time(). '.'. $extension; 
        $path = $request->file('name')->storeAs('/public/images/in',$filenameToStore); 
        $image = new \App\Models\Image;
        $image->int_no = $request->input('int_no');
        $image->type = 'in';
        $image->user_id = \Auth::id();
        $image->name = $filenameToStore;  
        $image->save(); 
        }
         
        return redirect()->route('stocks-in.index')->with('message', 'Stocks Added');
        // return view('stocks.in.multiple');
    }

}
