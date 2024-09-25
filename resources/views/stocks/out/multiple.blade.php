@extends('layouts.app')

@section('title')
    <h3>Multiple Out</h3>
@endsection

@section('content')
    <h1>Multiple Out</h1>
    <div class="container">
        <form enctype="multipart/form-data" method="POST" action="{{ route('stocks-out.multiple') }}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <select required name="member_id"  class="member_jq select2 form-control">
                        <option value="">Select Member</option>             
                      </select>
                </div>
                <div class="form-group col-md-4">
                    <input name="int_no" required type="name" class="form-control" id="name" placeholder="Int no">
                </div>
                <div class="form-group col-md-4">
                    <input name="date" required type="date" class="form-control" id="inputDate" placeholder="Date">
                </div>
                <div class="form-group col-md-4">
                    <input name="comment"  type="text" class="form-control" id="inputDate" placeholder="Comment">
                </div>
            </div>
            <div class="form-row newrow">

                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Item Name</td>
                            <td>Quantity</td>
                            <td>Action</td> 
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope='row' style="width: 100px"><input type="number" value="1" class="form-control"></td>
                            <td>
                                <select required name="item_id[]"  class="form-control">
                                    <option value="">Select Item</option>
                                    @foreach ($items as $item)
                                   <option value="{{$item->id}}">{{$item->name}} <span class="text-danger">(Item Left: {{$item->stocks_left}})</span> </option>
                                   @endforeach         
                                 </select>
                            </td>
                            <td>
                                <input name="quantity[]" required type="number" class="form-control" id="inputDate"
                                    placeholder="Quantity">
                            </td>
                            <td>
                                <span class="dd btn btn-primary">
                                    Add row
                                </span>
                                <span class="rr btn btn-danger">
                                    Remove row
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <div class="col-sm-9">
                    <input required type="file" class="form-control" name="name" @error('name') is-invalid @enderror
                        id="selectImage">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <img id="preview" src="#" alt="your name" class="mt-3 img-fluid" style="display:none;" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            selectImage.onchange = evt => {
                preview = document.getElementById('preview');
                preview.style.display = 'block';
                const [file] = selectImage.files
                if (file) {
                    preview.src = URL.createObjectURL(file)
                }
            }
        });
    </script>
    <script>
        $(document).on('click', '.dd', function() {
            var $tr = $(this).closest('tr');
            $tr.clone().appendTo('tbody').find("input").val("");
        });
        $(document).on('click', '.rr', function() {
            $(this).closest('tr').remove();
        });
    </script>

    @include('inc.member_list')
    @include('inc.items_list')
    @include('inc.select2')
@endsection
