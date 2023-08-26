@extends('layouts.app')

@section('title')
    <h3>Stock Out Edit</h3>
@endsection

@section('content')
<div class="text-center d-flex justify-content-center">
  <main class="py-2 w-50 border bg-white text-center">
    <form method="POST" action="{{route('stocks-out.update', $data->id)}}">
      @csrf
      <div class="mb-3">
        @error('name')
<div class="alert alert-danger" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror
        <input name="_method" type="hidden" value="PATCH">
        <label for="exampleInputEmail1" class="form-label">Item Name</label>
        <select required name="item_id"  class="form-control">
          @foreach ($items as $item)
         <option {{($data->item_id == $item->id) ? 'selected': ''}} value="{{$item->id}}">{{$item->name}} (Item Left: {{$item->stocks_left}})</option>
         @endforeach         
       </select>
        <label for="exampleInputEmail1" class="form-label">Int No</label>
        <input value="{{$data->int_no}}" required name="int_no" type="number" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">

        <label for="exampleInputEmail1" class="form-label">Member Name</label>
        <select required name="member_id"  class="form-control">
           @foreach ($members as $item)
          <option {{($data->member_id == $item->id) ? 'selected': ''}} value="{{$item->id}}">{{$item->name}}</option>
          @endforeach         
        </select>
        <label for="exampleInputEmail1" class="form-label">Quantity</label>
        <input value="{{$data->quantity}}" required name="quantity" type="number" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
        <label for="exampleInputEmail1" class="form-label">Date</label>
        <input value="{{$data->date}}" required name="date" type="date" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
        <label for="exampleInputEmail1" class="form-label">Comment</label>
        <input value="{{$data->comment}}" name="comment" type="text" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </main>

</div>
@endsection
</div>

