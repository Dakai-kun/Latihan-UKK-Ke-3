@extends('layout.dashboard')
@section('content')
    <section class="section">
        <div class="row">

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail Sales</h5>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-success color-white" href="/dashboard/detail/report">Export
                                Detail</a>
                            <a class="btn btn-primary color-white" href="/goods/product/create">Create Sales</a>
                        </div>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Sale Date</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $s)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $s->customer->customer_name }}</td>
                                        <td>{{ $s->customer->address }}</td>
                                        <td>{{ $s->customer->phone_number }}</td>
                                        <td>{{ $s->date }}</td>
                                        <td>Rp. {{ number_format($s->price_total, 0, ',', '.') }}</td>
                                        <td>
                                            <form action="{{ route('detail.destroy', $s->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#DetailModal{{ $s->id }}">Detail</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>
            </div>
        </div>
        @foreach ($sales as $s)
            <div class="modal fade" id="DetailModal{{ $s->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        @foreach ($detail as $d)
                            <div class="modal-body">
                                <div class="w-100 rounded" style="max-height: 200px; overflow-y: auto">
                                    <p class="m-0" style="line-height: 1.5em"><b>Nama Produk
                                            :</b>{{ $d->product->product_name }}</p>
                                    <p class="m-0" style="line-height: 1.5em"><b>Harga Satuan
                                            :</b>Rp{{ number_format($d->product->price, 0, ',' . '.') }}</p>
                                    <p class="m-0" style="line-height: 1.5em"><b>Total Produk
                                            :</b>{{ $d->quantity }} Unit</p>
                                    <p class="m-0" style="line-height: 1.5em"><b>Total Harga
                                            :</b>Rp{{ number_format($d->quantity * $d->product->price, 0, ',' . '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
        @endforeach
    </section>
@endsection
