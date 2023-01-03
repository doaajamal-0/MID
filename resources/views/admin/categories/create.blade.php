@extends('master')
@section('content')

<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" placeholder="Name" class="form-control" />
    </div>


    <div class="mb-3">
        <label for="image">Image</label>
        <input type="file" id="image" name="image" class="form-control" />
    </div>

    <div class="mb-3">
        <label>Parent</label>
        <select name="parent_id" class="form-control">
            <option value="">Select</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->trans_name }}</option>
            @endforeach
        </select>
    </div>

  <div class="col-md-4">
    <button class="btn btn-success px-5 ml-4">Add</button>
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
