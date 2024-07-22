@extends('layout.admin.app')
@section('productbrand', 'active')
@section('content')
<h3>Edit ProductBrand</h3>
    <div class="bg-light rounded p-4">
        <form action="{{ url('admin/productbrand/'.$brands->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ProductBrand Name</label>
                <input type="text" name="brand" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" value="{{ $brands->brand}}">
                @error('brand')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
