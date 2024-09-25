<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



<div class="container">

    <div class="text-center">
        <div class="row">
            <div class="col-3 text-start">
                {{-- <img class="img-fluid mt-1" width="100px" src="/img/fav.png" alt=""> --}}
            </div>
            <div class="col-6">
                <h3>Bangladesh Accreditation Council</h3>
                <h5>BSL Office Complex 2 (3rd Floor)</h5>
                <h6>1 Minto Road, Dhaka-100</h6>
                <h6><a href="www.bac.gov.bd">www.bac.gov.bd</a></h6>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">comment</th>
                <th scope="col">int_o</th>
                <th scope="col">Date</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $i => $data)
                <tr>
                    <th class="lighter" scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->item->name ?? '' }}</td>
                    <td>{{ $data->item->category->name ?? '' }}</td>
                    <td>{{ $data->comment ?? '' }}</td>
                    <td>{{ $data->int_no }}</td>
                    <td>{{ $data->date }}</td>
                    <td>{{ $data->quantity }}</td>
                    <td>{{ $data->price }}</td>
                    <td>{{ $data->price * $data->quantity }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
<span class="footer">Auto Generated Software</span>
<style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        color: red;
        text-align: right;
    }

    th.bold {
        font-weight: bold;
    }

    th.lighter {
        font-weight: lighter;
    }

    table {
        border-collapse: collapse;
    }

    table {
        border-left: 0.01em solid #ccc;
        border-right: 0;
        border-top: 0.01em solid #ccc;
        border-bottom: 0;
        border-collapse: collapse;
    }

    table td,
    table th {
        border-left: 0;
        border-right: 0.01em solid #ccc;
        border-top: 0;
        border-bottom: 0.01em solid #ccc;
        text-align: center;
    }
</style>
