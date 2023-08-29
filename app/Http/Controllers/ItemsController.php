<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemsController extends Controller
{
    

    protected $table = \App\Models\Item::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $datas = $this->table::latest()->paginate(10);
        $rank = $datas->firstItem();
        $category = \App\Models\Category::all();
        return view('items.index',compact('datas', 'rank', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = \App\Models\Category::all();
        return view('items.create',compact('category'));
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
            'category_id' => 'required',
            'name' => 'required|unique:items|min:3',
        ]);
        $datas = \Auth::user()->items()->create($request->all());;
        return redirect()->route('items.index')->with('message', 'Item Added');
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
        $category = \App\Models\Category::all();
        $data = $this->table::find($id);
        return view('items.edit',compact('data', 'category'));
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
            'category_id' => 'required',
            'name' => 'required',
        ]);
        $data=$this->table::findOrFail($id);
        $data->update([
        'name'=>$request->name,
        'category_id' =>  $request->category_id,
        'user_id' =>  \Auth::id(),
    ]);
        return redirect()->route('items.index')->with('message', 'Item Updated');
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
        return redirect()->route('items.index')->with('message', 'Item Deleted');
    }

    public function list(){
        $data = $this->table::all();
        return response()->json($data);
    }
}
