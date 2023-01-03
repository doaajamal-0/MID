@extends('master')
@section('content')

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="form-group">
    <label class="col-md-4 control-label" for="product_name">Product Name</label>
    <div class="col-md-4">
    <input id="product_name" name="name" placeholder="PRODUCT NAME" class="form-control input-md @error('name') is-invalid @enderror" type="text">
      @error('name')
        <small class="invalid-feedback">{{ $message }}</small>
      @enderror
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="quantity">Image</label>
    <div class="col-md-4">
    <input name="image" placeholder="Image" class="form-control input-md"  type="file">
        @if ($product->image)
            <img width="80" src="{{ asset('uploads/products/'.$product->image) }}" alt="">
        @endif
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="quantity">PRICE</label>
    <div class="col-md-4">
    <input name="price" placeholder="Price" class="form-control input-md @error('price') is-invalid @enderror"  type="number">
      @error('price')
        <small class="invalid-feedback">{{ $message }}</small>
      @enderror
    </div>
  </div>


  <div class="form-group">
    <label class="col-md-4 control-label" for="quantity">QUANTITY</label>
    <div class="col-md-4">
    <input name="quantity" placeholder="Quantity" class="form-control input-md @error('quantity') is-invalid @enderror"  type="number">
      @error('quantity')
        <small class="invalid-feedback">{{ $message }}</small>
                @enderror
    </div>
  </div>

  <div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control">
        <option value="">Select</option>
        @foreach ($categories as $item)
            <option @selected($product->category_id == $item->id) value="{{ $item->id }}">{{ $item->trans_name }}</option>
        @endforeach
    </select>
</div>

  <div class="col-md-4">
    <button id="btn_add" name="btn_add" class="btn btn-primary">Add</button>
  </div>
</form>


@stop










{{-- @extends('master')
@section('content')

    <form method="" action="">
        @csrf
        <div class="form-group">
            <label class="col-md-4 control-label" for="product_name">Product Name</label>
            <div class="col-md-4">
            <input id="product_name" name="name" placeholder="PRODUCT NAME" class="form-control input-md" type="text">

            </div>
          </div>


          <div class="form-group">
            <label class="col-md-4 control-label" for="quantity">PRICE</label>
            <div class="col-md-4">
            <input name="price" placeholder="Price" class="form-control input-md"  type="number">

            </div>
          </div>


          <div class="form-group">
            <label class="col-md-4 control-label" for="quantity">QUANTITY</label>
            <div class="col-md-4">
            <input name="quantity" placeholder="Quantity" class="form-control input-md"  type="number">

            </div>
          </div>

          <div class="col-md-4">
            <button id="btn_add" name="btn_add" class="btn btn-primary">Add</button>
          </div>
    </form>


@stop



 --}}
