<div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ProductBrand Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <span style="color:black;font-family:monospace" class="alert alert-warning">The modification will remain
                    the ‘Brand’ column <b>null</b> in the ‘Product’ table. </span>
                <form wire:submit.prevent="destroyProductBrand">
                    <div class="modal-body">
                        <h6>Are you sure you want to delete this data?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes .Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <h3>ProductBrand List</h3>
    @if (session('message'))
        <h3 class="alert alert-success">{{ session('message') }}</h3>
    @endif
    <div class="bg-light text-center rounded p-4">
        <div class="table-responsive">
          @if (Auth::user()->role == 1)
          <a href="{{ route('productbrand_create') }}" class="btn btn-primary m-2 float-end mb-3">Add ProductBrand</a>
          @endif
            <table class="table text-center text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>id</th>
                        <th>ProductBrand Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $idCounter = ($brands->currentPage() - 1) * $brands->perPage() + 1;
                    @endphp
                    @forelse ($brands as $brand)
                        <tr>
                            <td>{{ $idCounter }}</td>
                            <td>{{ $brand->brand }}</td>
                            <td>
                                @if (Auth::user()->role == 1)
                                    <a class="btn btn-success btn-sm"
                                        href="{{ url('/admin/productbrand/' . $brand->id . '/edit') }}">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm btn-dele"
                                        wire:click="deleteProductBrand({{ $brand->id }})" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">Delete</a>
                                @endif
                            </td>
                        </tr>
                        @php
                            $idCounter++;
                        @endphp
                    @empty
                        Not Found
                    @endforelse
                </tbody>
            </table>
            {{ $brands->links() }}
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#deleteModal').modal('hide');
        })
    </script>
@endpush
