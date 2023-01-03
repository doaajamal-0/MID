@extends('master')
@section('content')

<form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" placeholder="Name" class="form-control" />
    </div>

    <div class="mb-3">
        <label for="image">Image</label>
        <input type="file" id="image" name="image" class="form-control" />
        <img width="80" src="{{ asset('uploads/categories/'.$category->image) }}" alt="">
    </div>

    <div class="mb-3">
        <label>Parent</label>
        <select name="parent_id" class="form-control">
            <option value="">Select</option>
            @foreach ($categories as $item)
                <option {{ $category->parent_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}"></option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success px-5">Update</button>


</form>

@stop
