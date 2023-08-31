
@extends('layouts.app')

@section('title')
    <h3>Item Edit</h3>
@endsection

@section('content')
<div class="text-center d-flex justify-content-center">
  <main class="py-2 w-50 border bg-white text-center">
    <form method="POST" action="{{route('items.update', $data->id)}}">
      @csrf
      <input name="_method" type="hidden" value="PATCH">
      <div class="mb-3">
        @error('name')
<div class="alert alert-danger" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror
      <label for="exampleInputEmail1" class="form-label">Category Name</label>
      <select required name="category_id"  class="select2 form-control">
        <option value="">Select Category</option>
        @foreach ($category as $item)
       <option {{($data->category_id == $item->id) ? 'selected': ''}}  value="{{$item->id}}">{{$item->name}} </option>
       @endforeach         
    </select>  
        <label for="exampleInputEmail1" class="form-label">Item Name</label>
        <input required  name="name" value="{{$data->name}}" type="name" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
        <label class="form-label">Comment</label>
        <input  name="comment" value="{{$data->comment}}" type="name" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </main>

</div>
@include('inc.select2')
@endsection

