
@extends('layouts.app')

@section('title')
    <h3>Member List</h3>
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
  <a href="{{route('member.create')}}"><button type="button" class="d-flex justify-content-left btn btn-primary">
    Add New Member
  </button></a>
        <div class="d-flex justify-content-center">
        <table class="table w-50 table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Member Name</th>
                <th scope="col">Designation</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
              <tr>
                <th scope="row">{{$rank++}}</th>
                <td>{{$data->name}}</td>
                <td>{{$data->title}}</td>
                <td><a href="{{route('member.edit', $data->id)}}"><button class="btn btn-secondary">Edit</button></a></td>
                  <td>
                    <form method="post" action="{{ route('member.destroy', $data->id) }}">               
                      @csrf
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