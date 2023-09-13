
@extends('layouts.app')

@section('title')
    <h3>Items</h3>
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
  <a href="{{route('items.create')}}"><button type="button" class="d-flex justify-content-left btn btn-primary">
    Add New
  </button></a>
        <div class="d-flex justify-content-center">
        <table class="table w-50 table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Items Name</th>
                <th scope="col">Items Category</th>
                <th scope="col">Comment</th>
                @if(\Auth::id() == '1')
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                @endif
              </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
              <tr>
                <th scope="row">{{$rank++}}</th>
                <td>{{$data->name}}</td>
                <td>{{$data->category->name ?? ''}}</td>
                <td>{{$data->comment}}</td>
                @if(\Auth::id() == '1')
                <td><a href="{{route('items.edit', $data->id)}}"><button class="btn btn-secondary">Edit</button></a></td>
                  <td>
                    <form method="post" action="{{ route('items.destroy', $data->id) }}">               
                      @csrf
                      {{ method_field('DELETE') }}                
                      <button onclick="return confirm('Delete {{$data->name}} ?')" class="btn btn-danger" type="submit">Delete</button>
                  </form>  
                  </td>    
                  @endif           
              </tr>
              @endforeach
             
            </tbody>
          </table>
        </div>
    </main>
    {{ $datas->links("pagination::bootstrap-5") }}

</div>


@endsection
