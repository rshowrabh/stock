@extends('layouts.app')

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
      <div class="col">
            <!-- Button trigger modal -->
  <a href="{{route('images.create')}}"><button type="button" class="d-flex justify-content-left btn btn-primary">
    Add New
    </button></a>
      </div>
      <div class="col">
        <div class="col">
          <form action="{{route('image.search')}}" method="post">
            @csrf
            <div class="row">
              <div class="col-8">
                <select required name="int_no" class="select2 form-control">
                <option value="" >Select Here</option>
                @foreach ($allImages as $image)
                    <option value="{{$image->int_no}}">{{$image->int_no}}</option>
                @endforeach
               </select>
              </div>
              <div class="col-4">
                 <input type="submit" value="Search by Int No" class="btn btn-primary">
              </div>
            </div>
            </form>
        </div>
      </div>
    </div> 
    <div class="d-flex justify-content-center">
    <table class="my-2 table w-50 table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Int No</th>
            <th scope="col">Type</th>
            <th scope="col">Image</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
            @foreach($images as $image)
          <tr>
            <th scope="row">{{$image->id}}</th>
            <td>{{$image->int_no}}</td>
            <td>{{$image->type}}</td>
            <td><a data-gall="image" class="venobox" href="storage/images/{{$image->type}}/{{$image->name}}">
              <img width="50" height="50" class="thumbnail" src="/storage/images/{{$image->type}}/{{$image->name}}" alt="No Image">
            </a>
          </td>
            <td><a href="{{route('images.edit', $image->id)}}"><button class="btn btn-secondary">Edit</button></a></td>
              <td>
                <form method="post" action="{{ route('images.destroy', $image->id) }}">               
                  @csrf
                  {{ method_field('DELETE') }}                
                  <button onclick="return confirm('Delete {{$image->int_no}} ?')" class="btn btn-danger" type="submit">Delete</button>
              </form>  
              </td>               
          </tr>
          @endforeach
         
        </tbody>
      </table>
    </div>
</main>
{{ $images->links("pagination::bootstrap-5") }}
</div>

@include('inc.venobox')
@endsection
