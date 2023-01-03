@extends('master')
@section('content')

<div>
    <h2 class="h3 mb-4 text-gray-800"> All Products</h2>
    <table class="table table-hover">
        <tr class="table-dark">
            <th>ID</th>
            <th>NAME</th>
            <th>Image</th>
            <th>PRICE</th>
            <th>QUANTITY</th>
            <th>Category</th>
            <th>CREATED AT</th>
            <th>ACTIONS</th>
        </tr>


        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name}}</td>
            <td><img width="80" src="{{ asset('uploads/products/'.$product->image) }}" alt=""></td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->created_at? $product->created_at->diffForHumans() : ''}}</td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                <form class="d-inline" action="{{ route('products.destroy' , $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button  onclick="return confirm('Are You Sure !!')"  class="btn btn-sm  btn btn-danger" ><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>


        @endforeach
    </table>
    {{-- {{ $products->links() }} --}}
</div>

@stop
















{{-- @extends('master')
@section('content')

    <div class="container mt-5">
        <h2>All Products</h2>
        <table class="table table-hover table-borderd table-striped">
            <tr class="table-dark">
                <th>ID</th>
                <th>Name</th>
                <th>PRICE</th>
                <th>QUANTITY</th>
                <th>CREATED-AT</th>
                <th>UPDATED-AT</th>
                <th>ACTIONS</th>
            </tr>
            @foreach ($products as $product )
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->created_at->format('M d, Y')}}</td>
                <td>{{ $product->updated_at->format('M d, Y') }}</td>
                <td>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                    <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach

        </table>
        {{ $products->links() }}
    </div>

@stop --}}
