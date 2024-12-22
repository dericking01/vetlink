@extends('layouts.staff.ordermanbase')

@section('content')

<div class="card mb-3">
    <div class="card-header">
      <div class="row flex-between-end">
        <div class="col-auto align-self-center">
          <h5 class="mb-0" data-anchor="data-anchor" id="validation-example">Create an Order for a Customer<a class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#validation-example" style="padding-left: 0.375em;"></a></h5>
        </div>
        <div class="col-auto ms-auto">
          {{-- <div class="nav nav-pills nav-pills-falcon flex-grow-1" role="tablist"><button class="btn btn-sm active" data-bs-toggle="pill" data-bs-target="#dom-9648ceb7-3c34-49c3-86b0-a7d8bbd5b553" type="button" role="tab" aria-controls="dom-9648ceb7-3c34-49c3-86b0-a7d8bbd5b553" aria-selected="true" id="tab-dom-9648ceb7-3c34-49c3-86b0-a7d8bbd5b553">Preview</button><button class="btn btn-sm" data-bs-toggle="pill" data-bs-target="#dom-2307d37e-6055-418a-a859-44059ac8a954" type="button" role="tab" aria-controls="dom-2307d37e-6055-418a-a859-44059ac8a954" aria-selected="false" id="tab-dom-2307d37e-6055-418a-a859-44059ac8a954" tabindex="-1">Code</button></div> --}}
        </div>
      </div>
    </div>
    <div class="card-body bg-light">
      <div class="tab-content">
        <div class="tab-pane preview-tab-pane active show" role="tabpanel" aria-labelledby="tab-dom-9648ceb7-3c34-49c3-86b0-a7d8bbd5b553" id="dom-9648ceb7-3c34-49c3-86b0-a7d8bbd5b553">
            <form action="{{ route('orderman.storeOrder') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="novalidate">
                @csrf
                <div class="mb-3">
                    <label for="organizerSingle2">Customer's Name</label>
                    <select class="form-select js-choice" id="organizerSingle2" size="1" required="required" name="id" data-options='{"removeItemButton":true,"placeholder":true}'>
                        <option value="">Select name...</option>
                        @foreach ($agents as $agent)
                            <option value="{{ $agent->id }}" {{ old('name') == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select one</div>
                </div>

                <div class="mb-3">
                    <label for="organizerMultiple2">Products</label>
                    <select class="form-select js-choice" id="organizerMultiple2" multiple="multiple" size="1" name="name[]" required="required" data-options='{"removeItemButton":true,"placeholder":true}'>
                    <option value="">Select Product...</option>
                        @foreach ($products as $prod)
                            <option value="{{ $prod->id }}" {{ old('name') == $prod->id ? 'selected' : '' }}>{{ $prod->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select one or multiple</div>
                </div>

                <div id="quantityInputs"></div>

                <div class="mb-3">
                    <label for="discount">Discount</label>
                    <input type="number" step="0.01" class="form-control" id="discount" name="discount" placeholder="Enter discount amount" value="{{ old('discount') }}">
                    <div class="invalid-feedback">Please enter a valid discount amount</div>
                </div>

                <div class="mb-3">
                    <label for="payment_method">Payment Method</label>
                    <select class="form-select" id="payment_method" name="payment_method" required="required">
                        <option value="">Select payment method...</option>
                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="cheque" {{ old('payment_method') == 'cheque' ? 'selected' : '' }}>Cheque</option>
                        <option value="Bank" {{ old('payment_method') == 'Bank' ? 'selected' : '' }}>Bank</option>
                        <option value="Lipa namba" {{ old('payment_method') == 'Lipa namba' ? 'selected' : '' }}>Lipa namba</option>
                        <option value="Bank" {{ old('payment_method') == 'Bank' ? 'selected' : '' }}>Bank</option>
                        <option value="cheque" {{ old('payment_method') == 'cheque' ? 'selected' : '' }}>Cheque</option>
                        <!-- <option value="credit card" {{ old('payment_method') == 'credit card' ? 'selected' : '' }}>Credit Card</option> -->
                    </select>
                    <div class="invalid-feedback">Please select a payment method</div>
                </div>

                <div class="mb-3">
                    <label for="organizerSingle2">Branch Name</label>
                    <select class="form-select js-choice" id="organizerSingle2" size="1" required="required" name="branch" data-options='{"removeItemButton":true,"placeholder":true}'>
                        <option value="">Select branch...</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->branch_name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select one</div>
                </div>


                {{-- <div class="mb-3">
                    <label for="status">Order Status <span class="text-danger">*</span> </label>
                    <select class="form-select" id="organizerSingle2" size="1" name="status">
                        <option value="Completed" {{ old('status', $prod->status) === 'Completed' ? 'selected' : '' }}>COMPLETED</option>
                        <option value="Pending" {{ old('status', $prod->status) === 'Pending' ? 'selected' : '' }}>PENDING</option>
                    </select>
                </div> --}}

                <button class="btn btn-primary" type="submit">Confirm</button>
            </form>

        </div>
        {{-- <select class="form-select js-choice" required="required" data-options='{"removeItemButton":true,"placeholder":true}'
            id="name" name="name">
            <option value="">Select name...</option>
            @foreach ($productNames as $prodName)
            <option value="{{ $prodName->name }}" {{ old('name') == $prodName->id ? 'selected' : '' }}>{{ $prodName->name }}</option>
            @endforeach

        </select> --}}

      </div>
    </div>
  </div>

<script>
    // Script to add quantity inputs dynamically based on selected products
    document.getElementById('organizerMultiple2').addEventListener('change', function () {
    var selectedProducts = this.selectedOptions;
    var quantityInputsDiv = document.getElementById('quantityInputs');
    quantityInputsDiv.innerHTML = ''; // Clear previous quantity inputs

    // Create quantity input for each selected product
    for (var i = 0; i < selectedProducts.length; i++) {
        var productId = selectedProducts[i].value; // Get the product ID
        var productName = selectedProducts[i].text;

        var quantityLabel = document.createElement('label');
        quantityLabel.innerHTML = 'Quantity for ' + productName + ': ';

        var quantityInput = document.createElement('input');
        quantityInput.setAttribute('type', 'number');
        quantityInput.setAttribute('name', 'quantity[' + productId + ']'); // Use product ID as key
        quantityInput.setAttribute('placeholder', 'Enter quantity for ' + productName);
        quantityInput.setAttribute('class', 'form-control mb-3');

        quantityInputsDiv.appendChild(quantityLabel);
        quantityInputsDiv.appendChild(quantityInput);
    }
});

</script>
@endsection
