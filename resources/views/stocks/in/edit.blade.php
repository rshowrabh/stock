
@extends('layouts.app')

@section('title')
    <h3>Stock Edit</h3>
@endsection

@section('content')
<div class="text-center d-flex justify-content-center">
  <main class="py-2 w-50 border bg-white text-center">
    <form method="POST" action="{{route('stocks-in.update', $data->id)}}">
      @csrf
      <div class="mb-3">
        @error('name')
<div class="alert alert-danger" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror
        <input name="_method" type="hidden" value="PATCH">
        <label class="form-label">Item Name</label>
        <select required name="item_id"  class="select2 form-control form-select" aria-label="Default select example">
          @foreach ($items as $item)
              <option {{($data->item_id == $item->id) ? 'selected': ''}}  value="{{$item->id}}">{{$item->name}}</option>
          @endforeach
        </select>
        <label class="form-label">Intendent No</label>
        <input required name="int_no" value="{{$data->int_no}}" type="number" class="form-control"  aria-describedby="nameHelp">       
        <label class="form-label">Date</label>
        <input required name="date" value="{{$data->date}}" type="date" class="form-control"  aria-describedby="nameHelp">
        <label class="form-label">Qunatity</label>
        <input required name="quantity" value="{{$data->quantity}}" type="number" class="form-control"  aria-describedby="nameHelp">
        <label class="form-label">Price</label>
        <input required name="price" value="{{$data->price}}" type="number" class="form-control"  aria-describedby="nameHelp">
        <label class="form-label">Comment</label>
        <input  name="comment" value="{{$data->comment}}" type="text" class="form-control"  aria-describedby="nameHelp">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </main>

</div>
@include('inc.select2')
@endsection