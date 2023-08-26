<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function index(){
        $images = Image::paginate(10);
        return view('images.index')->with('images',$images);
      } 
      public function create(){
        return view('images.create');
      }
      public function store(Request $request){
        $this->validate($request, [
            'int_no' => 'required',
            'type' => 'required',
        ]);
        $filenameWithExt = $request->file('name')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME); 
        $extension =  $request->file('name')->getClientOriginalExtension(); 
        $filenameToStore = $filename.'-'.time(). '.'. $extension; 
        $path = $request->file('name')->storeAs('/public/images/'.$request->input('type'),$filenameToStore);
  
        $image = new Image;
        $image->int_no = $request->input('int_no');
        $image->type = $request->input('type');
        $image->user_id = \Auth::id();
        $image->name = $filenameToStore;  
        $image->save();  
        return redirect('/images')->with('message','Image Created');
      }
  
      public function show($id){
          $image = Image::find($id);
          return view('images.show')->with('image', $image);
      }
      public function destroy($id){
    	$image = Image::find($id);
    	if(Storage::move('public/images/'.$image->type.'/'.$image->name, 'public/images/'.$image->type.'/recycleBin/'.$image->name)){
    		$image->delete();
    		return redirect('/images')->with('message', 'Image Deleted');
    	}
    }
}
