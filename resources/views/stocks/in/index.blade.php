
@extends('layouts.app')

@section('title')
    <h3>Stocks In</h3>
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
  <div class="container">
    <div class="row">
      <div class="col-2">
        <a href="{{route('stocks-in.create')}}"><button type="button" class="d-flex justify-content-left btn btn-primary">
          Add New Stock
        </button></a>
      </div>
      <div class="col-4">
        <form action="{{route('search.name')}}" method="post">
          @csrf
          <div class="row">
            <div class="col-8"><input required class="form-control" type="text" name="search_name"></div>
            <div class="col-4"> <input class=" form-control btn btn-primary" type="submit" value="Search by Name"></div>
          </div>
          
         
          </form>
      </div>
      <div class="col-6">
        <form action="{{route('search.date')}}" method="post">
          @csrf
        <div class="row">
          <div class="col">
            <input required value="{{ old('search_date_from') }}" name="search_date_from" type="date" class="form-control" placeholder="First name" aria-label="First name">
          </div>
          <div class="col">
            <input required value="{{ old('search_date_to') }}" name="search_date_to" type="date" class="form-control" placeholder="Last name" aria-label="Last name">
          </div>
          <div class="col">
            <input type="Submit" class="form-control btn btn-primary" value="Search by Date" aria-label="Last name">
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
        <div class="d-flex justify-content-center">
        <table class="table w-auto table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Item Name</th>
                <th scope="col">Int No</th>
                <th scope="col">Category</th>
                <th scope="col">Date</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Total Price</th>
                <th scope="col">Commnet</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
              <tr>
                <th scope="row">{{$rank++}}</th>
                <td>{{$data->name}}</td>
                <td>{{$data->int_no}}</td>
                <td>{{$data->category->name}}</td>
                <td>{{$data->date}}</td>
                <td>{{$data->quantity}}</td>
                <td>{{$data->price}}</td>
                <td>{{$data->price * $data->quantity}}</td>
                <td>{{$data->comment}}</td>
                <td><a href="{{route('stocks-in.edit', $data->id)}}"><button class="btn btn-secondary">Edit</button></a></td>
                <td>
                  <form method="post" action="{{ route('stocks-in.destroy', $data->id) }}">
                    <!-- here the '1' is the id of the post which you want to delete -->
                
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                
                    <button onclick="return confirm('Delete {{$data->name}} ?')" class="btn btn-danger" type="submit">Delete</button>
                </form>  
                </td>
                
              </tr>
              @endforeach
             
            </tbody>
          </table>
        </div>
    </main>
    {{ $datas->links("pagination::bootstrap-5") }}

</div>


@endsection
