@extends('layout.dashboard')
@section('content')

<section class="section">
      <div class="row">

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Table with stripped rows</h5>
                    <a class="card-title color-blue" href="/goods/product/create">Create Product</a>
                </div>

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($product as $p)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$p->product_name}}</td>
                    <td>Rp. {{$p->price}}</td>
                    <td>{{$p->stock}}</td>
                    <td>
                        <form action="{{route('product.destroy', $p->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <a href="{{Route('product.edit', $p->id)}}" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateStockModal{{ $p->id }}">Add Stock</button>
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
          @foreach ($product as $p)
          <div class="modal fade" id="updateStockModal{{ $p->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Stock</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" action="{{ route('product.update.stock', $p->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                        <div class="col-12">
                                                            <label for="product_name" class="form-label">Stock</label>
                                                            <input type="text" class="form-control" name="stock"
                                                                id="product_name">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form><!-- Vertical Form -->
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
        </section>
@endsection