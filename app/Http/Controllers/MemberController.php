<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{

    protected $table = \App\Models\Member::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $datas = $this->table::paginate(10);
        $rank = $datas->firstItem();
        return view('member.index')->with(['datas' => $datas, 'rank' => $rank]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('member.create');
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
            'title' => 'required',
        ]);
        $datas = \Auth::user()->member()->create($request->all());;
        return redirect()->route('member.index')->with('message', 'Member Added');
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
        return view('member.edit')->with(['data' => $data]);
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
            'title' => 'required',
        ]);
        $data=$this->table::findOrFail($id);
        $data->update([
        'name'=>$request->name,
        'title'=>$request->title,
        'user_id' =>  \Auth::id(),
    ]);
        return redirect()->route('member.index')->with('message', 'Member Updated');
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
        return redirect()->route('member.index')->with('message', 'Member Deleted');
    }

    public function list(){
        $data = $this->table::all();
        return response()->json($data);
    }
}
