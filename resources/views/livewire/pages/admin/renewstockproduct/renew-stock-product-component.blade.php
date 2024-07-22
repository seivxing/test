<div>
    @include('livewire.pages.admin.renewstockproduct.model-form')

    @if (session('message'))
        <h3 class="alert alert-success">{{ session('message') }}</h3>
    @endif

    <div class="bg-light text-center rounded p-4">
        <div style="margin-bottom: 10px">
            <label for="startDate" style="display:flex">Start Date:</label>
            <input type="date" id="startDate" wire:model.live="startDate" class="form-control">
            <label for="endDate" style="display:flex">End Date:</label>
            <input type="date" id="endDate" wire:model.live="endDate" class="form-control">
        </div>
        <hr>
        <div class="table-responsive">

            <input wire:model.live="search" style="margin-right: 100px" type="text" placeholder="search model..."
                class="bg-gray-100 ml-2 rounded px-4 py-2 hover:bg-gray-100" />
            <label for="recordSelect" class="block text-sm font-medium text-gray-700">Record:</label>
            <select wire:model.live="perPage"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="500">500</option>
                <option value="all">All</option>
            </select>


            <button type="button" onclick="printElement('tablerenewstock')" class="btn btn-primary">Print</button>

            <div id="tablerenewstock">
                <div style="display: flex">
                    <h2 style="margin-top: 10px;margin-bottom:10px">RenewStock Product</h2>

                </div>
                <div>Total Amount between {{ $startDate }} to {{ $endDate }}: {{ $totalAmount }} USD </div>
                <table class="table  text-center text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th wire:click="toggleSort('id')">ID</th>
                            {{-- <th>Product_ID</th> --}}
                            <th>Model</th>
                            <th>Quantity</th>
                            <th>PRICE</th>
                            <th>TOTAL_AMOUNT </th>
                            <th>Create_At</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $idCounter = ($renewstocks->currentPage() - 1) * $renewstocks->perPage() + 1;
                        @endphp
                        @foreach ($renewstocks as $renewstock)
                            <tr>
                                <td>{{ $idCounter }}</td>
                                {{-- <td>{{ $renewstock->product_id }}</td> --}}
                                <td>{{ $renewstock->renewmodel }}</td>
                                <td>{{ $renewstock->renewquantity }}</td>
                                <td>{{ $renewstock->renewprice }}$</td>
                                <td>{{ $renewstock->total_amount }}$</td>
                                <td>{{ $renewstock->created_at }}</td>
                                <td class="no-print">
                                    @if (Auth::user()->role == 1)
                                    <div class="btn-group" role="group">
                                        <a type="" class="btn btn-success"
                                            wire:click="editStockProductrenew({{ $renewstock->id }})"
                                            data-bs-toggle="modal" data-bs-target="#editLaptopModal">Edit</a>
                                        <a type="" class="btn btn-danger"
                                            wire:click="deleteStockProduct({{ $renewstock->id }})"
                                            data-bs-toggle="modal" data-bs-target="#deleteLaptopModal">Delete</a>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @php
                                $idCounter++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2 float-end btn-sm">
                {{ $renewstocks->links() }}
            </div>
        </div>

    </div>
    <!-- Update Laptop Modal -->
    <div wire:ignore.self class="modal fade" id="editLaptopModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update RenewStock</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <span style="color: black;font-family: monospace ;font-size:20px"
                    class="alert alert-warning"><b>Note:</b>Adjusting the renewal quantity will affect the Product
                    table’s inventory. Please verify the changes for accurate inventory management </span>
                <form wire:submit.prevent="updateStockProduct">
                    @csrf
                    <div class="bg-light rounded h-100 p-4">

                        {{-- <div class="mb-3">

                            <input  type="text" wire:model.lazy="model"  class="form-control"  >

                            @error('model')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="mb-3">
                            <label style="font-size: 20px">Renew Quantity:</label>
                            <input style="font-size: 18px;color:black" type="number" wire:model="renewquantity"
                                class="form-control" placeholder="Quantity">
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label style="font-size: 20px">Price Per Item:</label>
                            <input style="font-size: 18px;color:black" type="number" wire:model="renewprice"
                                class="form-control" placeholder="Price">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete Laptop Modal -->
    <div wire:ignore.self class="modal fade" id="deleteLaptopModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Laptop Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyStockProduct">
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



</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addLaptopModal').modal('hide');
        })
    </script>
    <script>
        window.addEventListener('close-modal', event => {
            $('#editLaptopModal').modal('hide');
        })
    </script>
    <script>
        window.addEventListener('close-modal', event => {
            $('#deleteLaptopModal').modal('hide');
        })
    </script>
    <script>
        function printElement(elementId) {
            var printContents = document.getElementById(elementId).outerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endpush
