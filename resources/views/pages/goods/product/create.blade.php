@extends('layout.dashboard')
@section('content')

<section>
    <div class="row">
        <div class="col-lg-8">
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Create Product</h5>
                    
                    <!-- Vertical Form -->
                    <form class="row g-3" action="{{route('product.store')}}" method="POST">
                    @csrf
                        <div class="col-12">
                            <label for="inputName4" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="inputName4" name="product_name">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Price</label>
                            <input type="text" class="form-control" name="price">
                        </div>
                        <div class="col-6">
                            <label for="inputStock4" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="inputStock4" name="stock">
                        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
    </form><!-- Vertical Form -->
    
</div>
</div>
</div>
</section>
@endsection