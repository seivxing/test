@extends('layout.admin.app')

@section('slider', 'active')

@section('content')

    <h3>Add Slider</h3>
    <div class="bg-light rounded p-4">
        <form action="{{ route('slider_store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Title </label>
                <input type="text" name="title" class="form-control" id="">
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description </label>
                <textarea type="text" name="description" class="form-control" id=""> </textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Image </label>
                <input type="file" name="image" class="form-control" id="">
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Status </label>
                <input type="checkbox" name="status" class="form-control" id="" style="width: 30px;height: 30px;"/>
                Checked=Hidden,UnChecked=Visible
                @error('status')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

@endsection
