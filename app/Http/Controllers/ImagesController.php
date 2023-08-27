<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function index(){
        $images = Image::latest()->paginate(10);
        $allImages = Image::latest()->select('int_no')->distinct()->get();
        return view('images.index', compact('images', 'allImages'));
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
  
      public function edit($id){
          $image = Image::find($id);
          return view('images.edit')->with('image', $image);
      }
      public function update(Request $request, $id){
        $this->validate($request, [
          'int_no' => 'required',
          'type' => 'required',
      ]);
      $image = Image::findOrFail($id);
      if(Storage::move('public/images/'.$image->type.'/'.$image->name, 'public/images/'.$image->type.'/recycleBin/'.$image->name)){
    	}
      $image->int_no = $request->input('int_no');
      $image->type = $request->input('type');
      $image->user_id = \Auth::id();
      if ($request->file('name')) {
        $filenameWithExt = $request->file('name')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME); 
      $extension =  $request->file('name')->getClientOriginalExtension(); 
      $filenameToStore = $filename.'-'.time(). '.'. $extension; 
      $path = $request->file('name')->storeAs('/public/images/'.$request->input('type'),$filenameToStore);
         $image->name = $filenameToStore;
      }
        
      $image->save();  
      return redirect('/images')->with('message','Image Updated');
      }
      public function destroy($id){
    	$image = Image::find($id);
    	if(Storage::move('public/images/'.$image->type.'/'.$image->name, 'public/images/'.$image->type.'/recycleBin/'.$image->name)){
    		$image->delete();
    		return redirect('/images')->with('message', 'Image Deleted');
    	}
    }
    public function image_search(Request $request){
      $images = Image::where('int_no', $request->int_no)->latest()->paginate(10);
      $allImages = Image::latest()->select('int_no')->distinct()->get();
      return view('images.index',compact('images','allImages'));
  }
}
