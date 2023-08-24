
@extends('layouts.app')

@section('title')
    <h3>Stock Add</h3>
@endsection

@section('content')
<div class="text-center d-flex justify-content-center">
  <main class="py-2 w-50 border bg-white text-center">
    <form method="POST" action="{{route('stocks-in.store')}}">
      @csrf
      <div class="mb-3">
        @if($errors->any())
       {!! implode('', $errors->all('<div class="alert alert-danger" role="alert"><strong>:message</strong></div>')) !!}
        @endif
        <label class="form-label">Name</label>
        <input required value="{{ old('name') }}" name="name"  type="text" class="form-control"  aria-describedby="nameHelp">
        <label class="form-label">Intendent No</label>
        <input required value="{{ old('int_no') }}" name="int_no" type="number" class="form-control"  aria-describedby="nameHelp">
        <label class="form-label">Category</label>
        <select required name="category_id" id="sel_emp" class="form-select" aria-label="Default select example">
          <option value="" selected>Select Category</option>
        </select>
        <label class="form-label">Date</label>
        <input required value="{{ old('date') }}" name="date" type="date" class="form-control"  aria-describedby="nameHelp">
        <label  class="form-label">Qunatity</label>
        <input required value="{{ old('quantity') }}" name="quantity" type="number" class="form-control"  aria-describedby="nameHelp">
        <label class="form-label">Price</label>
        <input required value="{{ old('price') }}" name="price"  type="number" class="form-control"  aria-describedby="nameHelp">

        
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </main>

</div>
@endsection
</div>
@push('scripts')
    <script>
       jQuery(document).ready(function($){
   
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

       $.ajax({url: "{{route('category.list')}}", success: function(response){
            var len = 0;
            console.log(response.length)
             if(response != null){
               len = response.length;
             }
             if(len > 0){
               // Read data and create <option >
               for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var name = response[i].name;

                 var option = "<option value='"+id+"'>"+name+"</option>"; 

                 $("#sel_emp").append(option); 
               }
             
           }
        }});
       
});
    </script>
@endpush

