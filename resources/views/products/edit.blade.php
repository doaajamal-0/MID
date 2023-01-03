@extends('master')
@section('content')

<form action="{{ route('product.update', $product->id) }}" method="POST">
  @csrf
  @method('patch')

  <div class="form-group">
    <label class="col-md-4 control-label" for="product_name">Product Name</label>
    <div class="col-md-4">
    <input id="product_name" name="name" placeholder="PRODUCT NAME" class="form-control input-md @error('name') is-invalid @enderror" type="text" value="{{ $product->name }}">
  @error('name')
    <small class="invalid-feedback">{{ $message }}</small>
  @enderror
    </div>
  </div>


  <div class="form-group">
    <label class="col-md-4 control-label" for="quantity">PRICE</label>
    <div class="col-md-4">
    <input name="price" placeholder="Price" class="form-control input-md @error('price') is-invalid @enderror"  type="number" value="{{ $product->price }}">
  @error('price')
    <small class="invalid-feedback">{{ $message }}</small>
  @enderror
    </div>
  </div>


  <div class="form-group">
    <label class="col-md-4 control-label" for="quantity">QUANTITY</label>
    <div class="col-md-4">
    <input name="quantity" placeholder="Quantity" class="form-control input-md @error('quantity') is-invalid @enderror"  type="number" value="{{ $product->quantity }}">
  @error('quantity')
    <small class="invalid-feedback">{{ $message }}</small>
  @enderror
    </div>
  </div>

  <div class="col-md-4">
    <button id="btn_add" name="btn_add" class="btn btn-primary">Edit</button>
  </div>
</form>


@stop

