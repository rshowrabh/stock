
@extends('layouts.app')

@section('title')
    <h3>Stocks Left</h3>
@endsection

@section('content')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@error('name')
<div class="alert alert-danger" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror
<div class="text-center">
    <main class="py-2">
      <div class="row">
        <div class="col-4">
          <form action="{{route('stocks.search')}}" method="post">
            @csrf
            <div class="row">
              <div class="col-8">
                <select required name="item_id" class="js-example-basic-single form-control">
                <option value="" >Select Item</option>
                @foreach ($items as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
               </select>
              </div>
              <div class="col-4">
                 <input type="submit" value="Search by Item" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>
        <div class="d-flex justify-content-center">
        <table class="table w-50 table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Item Name</th>
                <th scope="col">Item In</th>
                <th scope="col">Item Out</th>
                <th scope="col">Item Left</th>
              </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
              <tr>
                @php
                    $in = $data->quantity;
                    $out = $data->stocksOut->quantity ?? '0';
                    $left = $in - $out;
                @endphp
                <th scope="row">{{$rank++}}</th>
                <td>{{$data->name}}</td>
                <td>{{$in}}</td>
                <td>{{$out}}</td>
                <td>{{$left}}</td>
                              
              </tr>
              @endforeach
             
            </tbody>
          </table>
        </div>
    </main>
    {{ $datas->links("pagination::bootstrap-5") }}

</div>
@endsection
@push('scripts')
  @include('inc.select2') 
@endpush
