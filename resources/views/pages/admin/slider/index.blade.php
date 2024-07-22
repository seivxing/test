@extends('layout.admin.app')

@section('slider', 'active')

@section('content')
    <div>

        <h3>Slider</h3>
        @if (session('message'))
            <h3 class="alert alert-success">{{ session('message') }}</h3>
        @endif
        <div class="bg-light text-center rounded p-4">
            <div class="table-responsive">
                @if (Auth::user()->role == 1)
                    <a href="{{ route('slider_create') }}" class="btn btn-primary m-2 float-end mb-3">Add Slider</a>
                @endif
                @if (Auth::user()->role == 2)
                <a href="{{ route('slider_create_sale') }}" class="btn btn-primary m-2 float-end mb-3">Add Slider</a>
            @endif
                <table class="table text-center text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th>ID</th>
                            <th>Title</th>
                            <th>Descriptoin</th>
                            <th>Iamge</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $slider)
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->description }}</td>
                                <td>
                                    <img src="{{ asset("$slider->image") }}" style="width: 70px; height:70px" alt="Slider">
                                </td>
                                <td>{{ $slider->status }}</td>
                                <td>
                                    @if (Auth::user()->role == 1)
                                        <a href="{{ url('admin/sliders/' . $slider->id . '/edit') }}"
                                            class="btn btn-success">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    @endif
                                    @if (Auth::user()->role == 2)
                                        <a href="{{ url('sale/sliders/' . $slider->id . '/edit') }}"
                                            class="btn btn-success">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $productcategory->links() }} --}}
            </div>
        </div>
    </div>



@endsection
