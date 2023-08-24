<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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
        
        $datas = $this->table::orderBy('date', 'DESC')->with('category')->paginate(10);
        $rank = $datas->firstItem();
        return view('stocks.in.index')->with(['datas' => $datas , 'rank' => $rank]);
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
            'name' => 'required',
            'int_no' => 'required',
            'category_id' => 'required',
            'date' => 'required|date',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        $datas = $this->table::create($request->all());;
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
        return view('stocks.in.edit')->with(['data' => $data]);
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
            'name' => 'required',
            'int_no' => 'required',
            'category_id' => 'required',
            'date' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        $data=$this->table::findOrFail($id);
        $data->fill($request->all())->save();
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
        $datas = $this->table::where('name', 'LIKE', "%{$request->search_name}%")->orderBy('date', 'DESC')->with('category')->paginate(10);
        $rank = $datas->firstItem();
        return view('stocks.in.index')->with(['datas' => $datas , 'rank' => $rank]);
    }

    public function search_date(Request $request){

        $from = date($request->search_date_from);
        $to = date($request->search_date_to);
        $datas = $this->table::whereBetween('date', [$from, $to])->orderBy('date', 'DESC')->with('category')->paginate(10);
        $rank = $datas->firstItem();
        return view('stocks.in.index')->with(['datas' => $datas , 'rank' => $rank]);
    }
}
