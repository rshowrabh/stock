
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
                <select required name="item_id" class="select2 form-control">
                <option value="" >Select Item </option>
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
        <div class="col-7 text-right">
          <a href="{{route('pdf')}}" class="btn btn-primary">Export to PDF</a>
        </div>
      </div>
        <div class="d-flex justify-content-center">
          <table class="my-2 table w-50 table-bordered">
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
                @foreach($datas as $i => $item)
              <tr>
                <th scope="row">{{$rank++}}</th>
                <th >{{$item->name}}</th>                           
               <th>{{$item->stocks_in_total}}</th>                        
               <th>{{$item->stocks_out_total}}</th>                    
               <th>{{$item->stocks_left}}</th>                    
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
