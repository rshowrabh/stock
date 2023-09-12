<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\StocksIn;
use App\Models\StocksOut;
use App\Models\Member;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getItems(Request $request)
    {
        $data = Item::orderBy('name')->get();
        return response()->json($data);
    }
    public function getInt()
    {
        $data = StocksIn::distinct('int_id')->orderBy('int_no', 'DESC')->pluck('int_no');
        return response()->json($data);
    }

    public function getIntOut()
    {
        $data = StocksOut::distinct('int_id')->orderBy('int_no', 'DESC')->pluck('int_no');
        return response()->json($data);
    }
    public function getMember()
    {
        $data = Member::orderBy('name')->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
