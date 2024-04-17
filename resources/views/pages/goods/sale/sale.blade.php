@extends('layout.dashboard')
@section('content')
    <section>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sale</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('sale.store') }}" method="POST">
                            @csrf
                            <div class="col-6">
                                <label for="inputName4" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="inputName4" name="customer_name">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number">
                            </div>
                            <div class="col-12">
                                <label for="inputStock4" class="form-label">Address</label>
                                <textarea class="form-control" cols="30" rows="3" id="inputStock4" name="address"></textarea>
                            </div>
                            <div id="productInputs">
                                <div class="card">
                                    <div class="card-body" style="background: transparent">

                                        <div class="row product-input mt-3">
                                            <div class="form-group col-md-6 col-sm-6 col-12">
                                                <label>Nama Produk<span class="text-danger">*</span></label>
                                                <select id="inputState" class="form-select" name="products[]">
                                                    @foreach ($product as $p)
                                                        <option value="{{ $p->id }}">{{ $p->product_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan isi Nama Produk
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-12">
                                                <label>Kuantitas<span class="text-danger">*</span></label>
                                                <input required type="number" name="quantities[]" id="stock"
                                                    value="0" class="form-control total-input">
                                                <div class="invalid-feedback">
                                                    Silahkan isi Kuantitas
                                                </div>
                                            </div>
                                            <div class="form-group col-12 mt-3">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removeProductInput(this)">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-primary" onclick="addProductInput()">Tambah Input
                                    Produk</button>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
    </section>
    <script>
        function addProductInput() {
            var productInputs = document.getElementById('productInputs');
            var newProductInput = productInputs.children[0].cloneNode(true);
            var dicountInput = document.getElementById('discount');
            productInputs.appendChild(newProductInput);
            newProductInput.querySelectorAll('input').forEach(function(input) {
                input.value = '';
                discountInput.value = 0;
            });
        }

        function removeProductInput(button) {
            var cardBody = button.closest('.card-body');
            cardBody.parentElement.remove();
        }
    </script>
@endsection
