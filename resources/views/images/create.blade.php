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
        <label class="form-label">Type</label>
        <select required class="form-control" name="type" id="type">
          <option value="">Select Type</option>
          <option value="in">Stock In</option>
          <option value="out">Stock Out</option>
        </select>
        <label class="form-label">Int No</label>
        <select class="select2 form-control" required name="int_no" id="int_no">
          
        </select>
        <label class="col-sm-3 col-form-label">Upload Image</label>
        <div class="col-sm-9">
        <input  type="file" class="form-control" name="name" @error('name') is-invalid @enderror id="selectImage">
         @error('name')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
         </span>
         @enderror
        <img id="preview" src="#" alt="your name" class="mt-3 img-fluid" style="display:none;"/>
      </div>
      <button type="submit" class="btn btn-primary my-2">Submit</button>
    </form>
  </main>

</div>

<script>
  $(document).ready(function () {
    selectImage.onchange = evt => {
      preview = document.getElementById('preview');
      preview.style.display = 'block';
      const [file] = selectImage.files
      if (file) {
          preview.src = URL.createObjectURL(file)
      }
  }
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
      $('#type').on('change', function () {
          var type = this.value;
          $("#int_no").html('<option value="">Select Int No</option>');
          $.ajax({
              url: "/get-int",
              type: 'POST',
              data: {
                  type: type,
              },
              success:function(response){
                
                        $.each(response, function (key, value) {
                            $("#int_no").append('<option value="' + value
                                .int_no + '">' + value.int_no + '</option>');
                        });
                    }
                
          });
      });
  });
</script>
@include('inc.select2')
@endsection

