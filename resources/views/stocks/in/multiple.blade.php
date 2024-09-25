@extends('layouts.app')

@section('title')
    <h3>Voucher Input Multiple Item</h3>
@endsection

@section('content')
    <div class="container">
        <form enctype="multipart/form-data" method="POST" action="{{ route('stocks-in.multiple') }}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input name="int_no" required type="name" class="form-control" id="name" placeholder="Int no">
                </div>
                <div class="form-group col-md-6">
                    <input name="date" required type="date" class="form-control" id="inputDate" placeholder="Date">
                </div>
            </div>
            <div class="form-row newrow">

                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Item Name</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Comment</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope='row' style="width: 100px"><input type="number" value="1" class="form-control"></td>
                            <td>
                                <select name="item_id[]" required type="name" class="items_jq form-control"
                                    id="name" placeholder="int_no">
                                    <option value="">Select</option>
                                </select>
                            </td>
                            <td>
                                <input name="quantity[]" required type="number" class="form-control" id="inputDate"
                                    placeholder="Quantity">
                            </td>
                            <td>
                                <input name="price[]" required type="number" class="form-control" id="inputDate"
                                    placeholder="Price">
                            </td>
                            <td>
                                <input name="comment[]"  type="text" class="form-control" id="inputDate"
                                    placeholder="Comment">
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

    @include('inc.items_list')
    @include('inc.select2')
@endsection
