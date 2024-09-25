<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StocksOutController extends Controller
{
    
    protected $table = \App\Models\StocksOut::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        $datas = $this->table::orderBy('int_no', 'DESC')->with('member')->with('item')->paginate();
        $rank = $datas->firstItem();
        return view('stocks.out.index',compact('datas', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $items = \App\Models\Item::latest()->get();
       return view('stocks.out.create',compact('items'));

    }

    /**
     * Store a newly created resource out storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required',
            'int_no' => 'required',
            'member_id' => 'required',
            'date' => 'required|date',
            'quantity' => 'required',
        ]);
        $datas = \Auth::user()->stocksOut()->create($request->all());;
        return redirect()->route('stocks-out.index')->with('message', 'Stocks Added');
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
        $data = $this->table::findOrFail($id);
        $members = \App\Models\Member::all();
        $items = \App\Models\Item::latest()->get();
        return view('stocks.out.edit',compact('data', 'members','items'));
    }

    /**
     * Update the specified resource out storage.
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
            'member_id' => 'required',
            'date' => 'required|date',
            'quantity' => 'required',
        ]);        
        $data=$this->table::findOrFail($id);
        $data->fill(['user_id' => \Auth::user()->id] + $request->all())->save();
        return redirect()->route('stocks-out.index')->with('message', 'Stocks Updated');
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
        return redirect()->route('stocks-out.index')->with('message', 'Stocks Deleted');
    }

    public function search_name(Request $request){
        $datas = $this->table::where('item_id', 'LIKE', $request->item_id)->orderBy('int_no', 'DESC')->with('member')->paginate(10)->withQueryString();
        $rank = $datas->firstItem();
        return view('stocks.out.index',compact('datas', 'rank'));
    }
    public function search_out_int(Request $request){
        $datas = $this->table::where('int_no', 'LIKE', $request->int_no)->orderBy('int_no', 'DESC')->with('item')->paginate()->withQueryString();
        $rank = $datas->firstItem();
        return view('stocks.out.index',compact('datas', 'rank'));
    }
    public function search_member(Request $request){
        $datas = $this->table::where('member_id', 'LIKE', $request->member_id)->orderBy('int_no', 'DESC')->with('member')->paginate()->withQueryString();
        $rank = $datas->firstItem();
        return view('stocks.out.index',compact('datas', 'rank'));
    }

    public function search_date(Request $request){

        $from = date($request->search_date_from);
        $to = date($request->search_date_to);
        $datas = $this->table::whereBetween('date', [$from, $to])->orderBy('int_no', 'DESC')->with('member')->paginate()->withQueryString();
        $rank = $datas->firstItem();
        return view('stocks.out.index',compact('datas', 'rank'));
    }
    public function multiple_out(){
        $datas = $this->table::orderBy('int_no', 'DESC')->with('item')->paginate();
        $rank = $datas->firstItem();
        $items = \App\Models\Item::orderBy('name')->get();
        return view('stocks.out.multiple',compact('datas', 'rank', 'items'));
    }
    public function multiple_out_store(Request $request){ 
        // return response()->json($request->all());
        foreach ($request->item_id as $index => $unit) {
            $units[] = [
        'int_no' =>  $request->input('int_no'),
        'date' =>  $request->input('date'),
        'member_id' =>  $request->input('member_id'),
        'comment' =>  $request->input('comment'),
        'item_id' =>  $request->input('item_id')[$index],
        'quantity' =>  $request->input('quantity')[$index],
        'user_id' => \Auth::id(),
            ];
        }
        $created = \Auth::user()->stocksOut()->insert($units);
        if ($request->file('name')) {
            $filenameWithExt = $request->file('name')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME); 
        $extension =  $request->file('name')->getClientOriginalExtension(); 
        $filenameToStore = $filename.'-'.time(). '.'. $extension; 
        $path = $request->file('name')->storeAs('/public/images/out',$filenameToStore); 
        $image = new \App\Models\Image;
        $image->int_no = $request->input('int_no');
        $image->type = 'out';
        $image->user_id = \Auth::id();
        $image->name = $filenameToStore;  
        $image->save(); 
        }
         
        return redirect()->route('stocks-out.index')->with('message', 'Stocks Added');
        // return view('stocks.in.multiple');
    }
}
