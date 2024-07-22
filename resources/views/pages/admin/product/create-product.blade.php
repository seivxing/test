@extends('layout.admin.app')

@section ('product','active')

@section('content')
<h3>Add Product</h3>
<div class="bg-light rounded p-4">
    <form action="{{ route('product_store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Start  --}}
        <div class="bg-light rounded h-100 p-4">
            <div class="mb-3">
                <select name="productcategory_id" id="" class="form-select mb-3">
                    <option value="">Select_Category</option>
                    @foreach ($productcategories as $productcategory)
                        <option value="{{ $productcategory->id }}">{{ $productcategory->category_name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <select name="brand_id" id="" class="form-select mb-3">
                    <option value="">Select_Brand</option>
                    @foreach ($productbrands as $productbrand)
                        <option value="{{ $productbrand->id }}">{{ $productbrand->brand }}</option>
                    @endforeach
                </select>
                @error('brand_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="text" name="model" class="form-control" placeholder="Model">
                @error('model')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="text" name="price" class="form-control" placeholder="Price">
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="input-group-text"> </span>
                <input type="number" name="quantity" class="form-control" placeholder="Quantity">
                @error('quantity')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="text" name="gpu" class="form-control" placeholder="GPU">
                @error('gpu')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="input-group-text"> </span>
                <input type="text" name="cpu" class="form-control" placeholder="CPU">
                @error('cpu')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="input-group-text"> </span>
                <input type="text" name="ram" class="form-control" placeholder="RAM">
                @error('ram')
                    <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
            <div class="input-group mb-3">
                <input type="text" name="color" class="form-control" placeholder="Color" required>
                @error('color')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="input-group-text"> </span>
                <input type="text" name="display" class="form-control" placeholder="Display">
                @error('display')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="text" name="weight" class="form-control" placeholder="Weight">
                @error('weight')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="input-group-text"> </span>
                <input type="text" name="battery" class="form-control" placeholder="Battery">
                @error('battery')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="text" name="official_warranty" class="form-control"
                    placeholder="Official_Warranty">
                @error('official_warranty')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label p-1">Image</label>
                <input type="file" name="image" accept="image/png, image/jpeg"  required
                       class="ring-1 ring-inset ring-gray-300 bg-gray-100 text-gray-900 text-sm rounded block w-full form-control">
                @error('image')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            <div class="mb-3">
                <textarea type="text" name="description" class="form-control" placeholder="Description"> </textarea>
            </div>
        </div>


            <button type="submit" class="btn btn-primary">Add</button>

        {{-- End --}}
    </form>
</div>


@endsection
