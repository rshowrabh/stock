
@extends('layouts.app')

@section('title')
    <h3>Member Add</h3>
@endsection

@section('content')
<div class="text-center d-flex justify-content-center">
  <main class="py-2 w-50 border bg-white text-center">
    <form method="POST" action="{{route('member.store')}}">
      @csrf
      <div class="mb-3">
        @error('name')
      <div class="alert alert-danger" role="alert">
       <strong>{{ $message }}</strong>
      </div>
      @enderror
        <label class="form-label">Member Name</label>
        <input required value="{{ old('name') }}" name="name" type="text" class="form-control"  aria-describedby="nameHelp">
        <label class="form-label">Member Designation</label>
        <input required value="{{ old('title') }}" name="title" type="text" class="form-control"  aria-describedby="nameHelp">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </main>

</div>
@endsection
</div>

