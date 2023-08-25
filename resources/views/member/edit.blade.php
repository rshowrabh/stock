
@extends('layouts.app')

@section('title')
    <h3>Member Edit</h3>
@endsection

@section('content')
<div class="text-center d-flex justify-content-center">
  <main class="py-2 w-50 border bg-white text-center">
    <form method="POST" action="{{route('member.update', $data->id)}}">
      @csrf
      <div class="mb-3">
        @error('name')
<div class="alert alert-danger" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror
        <input name="_method" type="hidden" value="PATCH">
        <label for="name" class="form-label">Member Name</label>
        <input required  name="name" value="{{$data->name}}" type="text" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
        <label for="exampleInputEmail1" class="form-label">Designation</label>
        <input required  name="title" value="{{$data->title}}" type="text" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </main>

</div>
@endsection
</div>

