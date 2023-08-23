
@extends('layouts.app')

@section('title')
    <h3>Stocks</h3>
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
        <!-- Button trigger modal -->
  <a href="{{route('stocks-in.create')}}"><button type="button" class="d-flex justify-content-left btn btn-primary">
    Add New
  </button></a>
        <div class="d-flex justify-content-center">
        <table class="table w-50 table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Int No</th>
                <th scope="col">Category</th>
                <th scope="col">Date</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Total Price</th>
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
                <td class="cat{{$data->category_id}}">A</td>
                <td>{{$data->date}}</td>
                <td>{{$data->quantity}}</td>
                <td>{{$data->price}}</td>
                <td>{{$data->price * $data->quantity}}</td>
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
@push('scripts')

    <script>
   jQuery(document).ready(function($){
   
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

       $.ajax({url: "{{route('category.list')}}", success: function(result){
        for (let i = 0; i < result.length; ++i) {
            $('.cat'+result[i].id).html(result[i].name)
            console.log(result[i].name)
          }
        }});
       
});
    </script>
@endpush