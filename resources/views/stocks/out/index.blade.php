@extends('layouts.app')


@section('title')
    <h3>Stock Out</h3>
@endsection
@section('new-button')
    <a href="{{ route('stocks-out.create') }}" class="btn btn-secondary btn-sm">
        New Stocks Out
    </a>
@endsection


@section('content')
    @if (session()->has('message'))
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
                <table class="my-2 table table-bordered text-center">
                    <tbody>
                        <tr>
                            <td>
                                <form action="{{ route('search.out.int') }}" method="get">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <select required name="int_no" class="int_jq_out select2 form-control">
                                                <option value="">Select Item</option>

                                            </select>
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary svg">Search by Int No
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('search.out.member') }}" method="get">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <select required name="member_id" class="member_jq select2 form-control">
                                                <option value="">Select Member</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary svg">
                                                Search By Member
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <form action="{{ route('search.out.name') }}" method="get">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <select required name="item_id" class="items_jq select2 form-control">
                                                <option value="">Select Item</option>

                                            </select>
                                        </div>
                                        <div class="col">
                                            <button type="submit" value="" class="btn btn-primary svg">
                                                Item Search
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('search.out.date') }}" method="get">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <input required value="{{ old('search_date_from') }}" name="search_date_from"
                                                type="date" class="form-control" placeholder="First name"
                                                aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <input required value="{{ old('search_date_to') }}" name="search_date_to"
                                                type="date" class="form-control" placeholder="Last name"
                                                aria-label="Last name">
                                        </div>
                                        <div class="col">
                                            <button type="Submit" class="form-control btn btn-primary svg"
                                                aria-label="Last name"> Date Search
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                            <th scope="col">Comment</th>
                            <th scope="col">Image</th>
                            @if (\Auth::id() == '1')
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <th scope="row">{{ $rank++ }}</th>
                                <td>{{ $data->int_no }}</td>
                                <td>{{ $data->item->name ?? '' }}</td>
                                <td>{{ $data->member->name ?? '' }}</td>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->quantity }}</td>
                                <td>{{ $data->comment ?? '' }}</td>
                                <td>
                                    @if ($data->image)
                                        <a class="venobox" data-gall="{{ $data->image->type }}"
                                            href="storage/images/{{ $data->image->type }}/{{ $data->image->name }}">
                                            <img class="img-fluid" width="50" height="50"
                                                src="/storage/images/{{ $data->image->type }}/{{ $data->image->name }}"
                                                alt="No image">
                                        </a>
                                    @endif
                                </td>
                                @if (\Auth::id() == '1')
                                    <td><a href="{{ route('stocks-out.edit', $data->id) }}"><button
                                                class="btn btn-secondary">Edit</button></a></td>
                                    <td>
                                        <form method="post" action="{{ route('stocks-out.destroy', $data->id) }}">
                                            <!-- here the '1' is the id of the post which you want to delete -->

                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button onclick="return confirm('Delete {{ $data->name }} ?')"
                                                class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                @endif

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </main>
        {{ $datas->links('pagination::bootstrap-5') }}

    </div>
    @include('inc.venobox')
@endsection

@push('scripts')
    @include('inc.int_list_out')
    @include('inc.items_list')
    @include('inc.member_list')
    @include('inc.select2')
@endpush
