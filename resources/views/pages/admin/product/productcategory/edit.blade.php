@extends('layout.admin.app')
@section('productcategory', 'active')
@section('content')
<h3>Edit ProductCategory</h3>
    <div class="bg-light rounded p-4">
        <form action="{{ url('admin/productcategory/'.$productcategory->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ProductCategory Name</label>
                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" value="{{ $productcategory->category_name}}">
                @error('category_name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
