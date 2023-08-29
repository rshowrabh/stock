
@extends('layouts.app')

@section('title')
  <div class="row">
    <div class="col"><h3>Stock Out</h3></div>
    <div class="col">
        <a style="white-space: nowrap" class="btn btn-primary" href="{{route('stocks-out.create')}}">
          New Stock Out</a>
      </div>
    </div>
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
  <div class="container">
    <div class="row">
      <div class="col-3">
        <form action="{{route('search.out.member')}}" method="post">
          @csrf
          <div class="row">
            <div class="col">
              <select required name="member_id" class="select2 form-control">
              <option value="" >Select Item</option>
              @foreach ($members as $member)
                  <option value="{{$member->id}}">{{$member->name}}</option>
              @endforeach
             </select>
            </div>
            <div class="col">
               <input type="submit" value="Search By Member" class="btn btn-primary">
            </div>
          </div>
          </form>
      </div>
      <div class="col-3">
        <form action="{{route('search.out.name')}}" method="post">
          @csrf
          <div class="row">
            <div class="col">
              <select required name="item_id" class="select2 form-control">
              <option value="" >Select Item</option>
              @foreach ($items as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
             </select>
            </div>
            <div class="col">
               <input type="submit" value="Item Search" class="btn btn-primary">
            </div>
          </div>
          </form>
      </div>
      <div class="col-5">
        <form action="{{route('search.out.date')}}" method="post">
          @csrf
        <div class="row">
          <div class="col">
            <input required value="{{ old('search_date_from') }}" name="search_date_from" type="date" class="form-control" placeholder="First name" aria-label="First name">
          </div>
          <div class="col">
            <input required value="{{ old('search_date_to') }}" name="search_date_to" type="date" class="form-control" placeholder="Last name" aria-label="Last name">
          </div>
          <div class="col">
            <input type="Submit" class="form-control btn btn-primary" value="Date Search" aria-label="Last name">
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
        <div class="d-flex justify-content-center">
        <table class="my-2 table w-auto table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Int No</th>
                <th scope="col">Item Name</th>
                <th scope="col">Member Name</th>                
                <th scope="col">Date</th>
                <th scope="col">Quantity</th>
                <th scope="col">Commnet</th>
                <th scope="col">Image</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
              <tr>
                <th scope="row">{{$rank++}}</th>
                <td>{{$data->int_no}}</td>
                <td>{{$data->item->name ?? ''}}</td>
                <td>{{$data->member->name ?? ''}}</td>
                <td>{{$data->date}}</td>
                <td>{{$data->quantity}}</td>
                <td>{{$data->comment}}</td>
                <td>
                  @if($data->image)
                  <a class="venobox" data-gall="{{$data->image->type}}" href="storage/images/{{$data->image->type}}/{{$data->image->name}}">
                  <img class="img-fluid" width="50" height="50" src="/storage/images/{{$data->image->type}}/{{$data->image->name}}" alt="No image">
                </a>
                @endif
              </td>
                <td><a href="{{route('stocks-out.edit', $data->id)}}"><button class="btn btn-secondary">Edit</button></a></td>
                <td>
                  <form method="post" action="{{ route('stocks-out.destroy', $data->id) }}">
                    <!-- here the '1' is the id of the post which you want to delete -->
                
                    {{ csrf_field() }}
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
@include('inc.venobox')
@endsection

@push('scripts')
  @include('inc.select2') 
@endpush
