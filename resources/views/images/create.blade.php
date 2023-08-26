@extends('layouts.app')

@section('content')
<div class="text-center d-flex justify-content-center">
  <main class="py-2 w-50 border bg-white text-center">
    <form enctype="multipart/form-data" method="POST" action="{{route('images.store')}}">
      @csrf
      <div class="mb-3">
        @error('name')
      <div class="alert alert-danger" role="alert">
       <strong>{{ $message }}</strong>
      </div>
      @enderror
        <label class="form-label">Int No</label>
        <input required value="{{ old('int_no') }}" name="int_no" type="number" class="form-control"  aria-describedby="nameHelp">
        <label class="form-label">Type</label>
        <select required class="form-control" name="type" id="">
          <option value="in">Stock In</option>
          <option value="out">Stock Out</option>
        </select>
        <label class="col-sm-3 col-form-label">Upload Image</label>
        <div class="col-sm-9">
        <input  type="file" class="form-control" name="name" @error('name') is-invalid @enderror id="selectImage">
         @error('name')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
         </span>
         @enderror
        <img id="preview" src="#" alt="your name" class="mt-3" style="display:none;"/>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </main>

</div>
<script>
  selectImage.onchange = evt => {
      preview = document.getElementById('preview');
      preview.style.display = 'block';
      const [file] = selectImage.files
      if (file) {
          preview.src = URL.createObjectURL(file)
      }
  }
</script>
@endsection

