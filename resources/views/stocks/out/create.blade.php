
@extends('layouts.app')

@section('title')
    <h3>Stock Out Page</h3>
@endsection

@section('content')
<div class="text-center d-flex justify-content-center">
  <main class="py-2 w-50 border bg-white text-center">
    <form method="POST" action="{{route('stocks-out.store')}}">
      @csrf
      <div class="mb-3">
        @error('name')
      <div class="alert alert-danger" role="alert">
       <strong>{{ $message }}</strong>
      </div>
      @enderror
        <label for="exampleInputEmail1" class="form-label">Item Name</label>
        <select required name="item_id"  class="select2 form-control">
          <option value="">Select Item</option>
          @foreach ($items as $item)
         <option value="{{$item->id}}">{{$item->name}} <span class="text-danger">(Item Left: {{$item->stocks_left}})</span> </option>
         @endforeach         
       </select>
        
        <label for="exampleInputEmail1" class="form-label">Int No</label>
        <input required name="int_no" type="number" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">

        <label for="exampleInputEmail1" class="form-label">Member Name</label>
        <select required name="member_id"  class="select2 form-control">
          <option value="">Select Member</option>
          @foreach ($members as $item)
          <option value="{{$item->id}}">{{$item->name}}</option>
          @endforeach        
        </select>
        <label for="exampleInputEmail1" class="form-label">Quantity</label>
        <input required name="quantity" type="number" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
        <label for="exampleInputEmail1" class="form-label">Date</label>
        <input required name="date" type="date" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
        <label for="exampleInputEmail1" class="form-label">Comment</label>
        <input name="comment" type="text" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">

      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </main>

</div>
@include('inc.select2')
@endsection

