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
        $datas = $this->table::orderBy('date', 'DESC')->with('member')->with('item')->paginate();
        $rank = $datas->firstItem();
        $items = \App\Models\Item::all();
        $members = \App\Models\Member::all();
        return view('stocks.out.index',compact('datas', 'rank', 'items', 'members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $members = \App\Models\Member::all();
       $items = \App\Models\Item::latest()->get();
       return view('stocks.out.create',compact('members','items'));

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
        $datas = $this->table::where('item_id', 'LIKE', $request->item_id)->orderBy('date', 'DESC')->with('member')->paginate();
        $rank = $datas->firstItem();
        $items = \App\Models\Item::all();
        $members = \App\Models\Member::all();
        return view('stocks.out.index',compact('datas', 'rank', 'items','members'));
    }
    public function search_out_int(Request $request){
        $datas = $this->table::where('int_no', 'LIKE', $request->int_no)->orderBy('date', 'DESC')->with('item')->paginate();
        $rank = $datas->firstItem();
        $items = \App\Models\Item::all();
        $members = \App\Models\Member::all();
        return view('stocks.out.index',compact('datas', 'rank', 'items','members'));
    }
    public function search_member(Request $request){
        $datas = $this->table::where('member_id', 'LIKE', $request->member_id)->orderBy('date', 'DESC')->with('member')->paginate();
        $rank = $datas->firstItem();
        $items = \App\Models\Item::all();
        $members = \App\Models\Member::all();
        return view('stocks.out.index',compact('datas', 'rank', 'items','members'));
    }

    public function search_date(Request $request){

        $from = date($request->search_date_from);
        $to = date($request->search_date_to);
        $datas = $this->table::whereBetween('date', [$from, $to])->orderBy('date', 'DESC')->with('member')->paginate();
        $rank = $datas->firstItem();
        $items = \App\Models\StocksIn::all();
        $members = \App\Models\Member::all();
        return view('stocks.out.index',compact('datas', 'rank', 'items','members'));
    }
}
