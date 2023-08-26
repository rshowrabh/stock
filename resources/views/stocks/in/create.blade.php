
@extends('layouts.app')

@section('title')
    <h3>Stock Add</h3>
@endsection

@section('content')
<div class="text-center d-flex justify-content-center">
  <main class="py-2 w-50 border bg-white text-center">
    <form method="POST" action="{{route('stocks-in.store')}}">
      @csrf
      <div class="mb-3">
        @if($errors->any())
       {!! implode('', $errors->all('<div class="alert alert-danger" role="alert"><strong>:message</strong></div>')) !!}
        @endif
        <label class="form-label">Item Name</label>
        <select required name="item_id" id="sel_emp" class="select2 form-select" aria-label="Default select example">
          <option value="" selected>Select Item</option>
          @foreach ($items as $item)
          <option class="form-control" value="{{$item->id}}" >{{$item->name}}</option>
          @endforeach
          
        </select>
        <label class="form-label">Intendent No</label>
        <input required value="{{ old('int_no') }}" name="int_no" type="number" class="form-control"  aria-describedby="nameHelp">      
        <label class="form-label">Date</label>
        <input required value="{{ old('date') }}" name="date" type="date" class="form-control"  aria-describedby="nameHelp">
        <label  class="form-label">Qunatity</label>
        <input required value="{{ old('quantity') }}" name="quantity" type="number" class="form-control"  aria-describedby="nameHelp">
        <label class="form-label">Price</label>
        <input required value="{{ old('price') }}" name="price"  type="number" class="form-control"  aria-describedby="nameHelp">
        <label class="form-label">Comment</label>
        <input  value="{{ old('comment') }}" name="comment"  type="text" class="form-control"  aria-describedby="nameHelp">

        
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </main>

</div>

@include('inc.select2')
@endsection


