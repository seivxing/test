<div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ProductCategory Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyProductCategory">
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


    <h3>Product Category List</h3>
    @if (session('message'))
        <h3 class="alert alert-success">{{ session('message') }}</h3>
    @endif
    <div class="bg-light text-center rounded p-4">
        <div class="table-responsive">
            @if (Auth::user()->role == 1)
                <a href="{{ route('productcategory_create') }}" class="btn btn-primary m-2 float-end mb-3">Add
                    ProductCategory</a>
            @endif
            <table class="table text-center text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>id</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $idCounter = ($productcategory->currentPage() - 1) * $productcategory->perPage() + 1;
                    @endphp
                    @forelse ($productcategory as $productcategory)
                        <tr>
                            <td>{{ $idCounter }}</td>
                            <td>{{ $productcategory->category_name }}</td>
                            <td>
                                @if (Auth::user()->role == 1)
                                    <a class="btn btn-success btn-sm"
                                        href="{{ url('/admin/productcategory/' . $productcategory->id . '/edit') }}">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm btn-dele"
                                        wire:click="deleteProductCategory({{ $productcategory->id }})"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
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
            {{-- {{ $productcategory->links() }} --}}
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
