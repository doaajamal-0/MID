@extends('master')
@section('content')

    <h1 class="h3 mb-4 text-gray-800"> All Catgories</h1>
    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif
    <div>
        <table class="table table-hover ">
        <thead>
            <tr class="table-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Parent</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name}}</td>
                <td><img width="80" height="80" src="{{ asset('uploads/categories/'.$category->image) }}" alt=""></td>
                <td>{{ $category->parent->name }}</td>
                <td>{{ $category->created_at ? $category->created_at->diffForHumans() : ''}}</td>
                <td>{{ $category->updated_at ? $category->updated_at->diffForHumans() : ''}}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                    <form class="d-inline" action="{{ route('categories.destroy' , $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button  onclick="return confirm('Are You Sure !!')"  class="btn btn-sm btn btn-danger" ><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
</div>


@stop


