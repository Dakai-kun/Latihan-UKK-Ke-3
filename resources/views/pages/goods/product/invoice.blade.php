@extends('layout.dashboard')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>
                Invoice
            </h5>
        </div>
        <div class="card-body">
            <div>Customer Name: {{ $customer['customer_name'] }}</div>
            <div>Customer Address: {{ $customer['address'] }}</div>
            <div>Customer Phone: {{ $customer['phone_number'] }}</div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $d)
                        <tr>
                            <th>{{ $d->product->product_name }}</th>
                            <td>{{ $d['quantity'] }}</td>
                            <td>Rp{{ number_format($d->product->price, 0, ',' . '.') }}</td>
                            <td>Rp{{ number_format($d['subtotal'], 0, ',' . '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>Total Price: Rp{{ number_format($sale->price_total, 0, ',' . '.') }}</div>
            <div class="d-flex justify-content-end">
                <a href="{{ Route('delete.sale', $sale->id) }}" class="btn btn-danger">Cancel</a>
                <form action="{{ route('sale.store') }}" method="post">
                    @csrf
                    <a href="/dashboard/detail" class="btn btn-primary" type="submit">Confirm</a>
                </form>
            </div>
        </div>
    </div>
@endsection
