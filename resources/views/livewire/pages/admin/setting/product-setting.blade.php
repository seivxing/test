<div>

    <h3>Product Setting</h3>

    @if (session('message'))
        <h3 class="alert alert-success">{{ session('message') }}</h3>
    @endif

    <div class="bg-light text-center rounded p-4">
        <div class="flex items-center space-x-4 mb-4">
            <label for="search" class="text-gray-600">Search</label>
            <input type="text" class="border border-gray-300 rounded-md p-2" wire:model.live="search">
            <label for="start_date" class="text-gray-600">Start Date:</label>
            <input id="start_date" type="date" wire:model.live="start_date"
                class="border rounded-md px-2 py-1 focus:outline-none focus:ring focus:border-blue-300">
            <label for="end_date" class="text-gray-600">End Date:</label>
            <input id="end_date" type="date" wire:model.live="end_date"
                class="border rounded-md px-2 py-1 focus:outline-none focus:ring focus:border-blue-300">

            <button wire:click="deleteProducts"
                wire:confirm.prompt="Are you sure  {{ $start_date }} to {{ $end_date }}?\n Type CONFIRM to confirm |CONFIRM"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md focus:outline-none"
                style="background-color: rgb(245, 118, 118) !important; color:black !important">
                Delete Products in Period
            </button>
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
            {{-- <button wire:click="resetTable" wire:confirm="“Confirm ID reset? Works only if ‘product’ table is empty.”"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md focus:outline-none"
                style="background: rgb(36, 149, 241) !important;">Reset </button> --}}
        </div>
        <div class="table-responsive">
            <table class="table text-start text-center align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>ID</th>
                        <th>Category_Name</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>GPU</th>
                        <th>CPU</th>
                        <th>RAM</th>
                        <th>Quantity</th>
                        <th>Color</th>
                        <th>Display</th>
                        <th>Weight</th>
                        <th>Battery</th>
                        <th>Official_Warranty</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $idCounter = ($products->currentPage() - 1) * $products->perPage() + 1;
                    @endphp
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $idCounter }}</td>
                            <td>{{ $product->productcategory->category_name }}</td>
                            <td>{{ $product->productbrand->brand }}</td>
                            <td>{{ $product->model }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->gpu }}</td>
                            <td>{{ $product->cpu }}</td>
                            <td>{{ $product->ram }}</td>
                            <td style="{{ $product->quantity < 3 ? 'background-color: #FFCCCC !important;' : '' }}">
                                {{ $product->quantity }}
                            </td>
                            <td>{{ $product->color }}</td>
                            <td>{{ $product->display }}</td>
                            <td>{{ $product->weight }}</td>
                            <td>{{ $product->battery }}</td>
                            <td>{{ $product->official_warranty }}</td>
                            <td><a href="{{ asset('storage/' . $product->image) }}" download><img
                                        src="{{ asset('storage/' . $product->image) }}" style=" width:80px !important"
                                        alt="" class="img-fluid"></a>
                            </td>
                            <td>{{ $product->description }}</td>
                            <td>

                            </td>
                        </tr>
                        @php
                            $idCounter++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-2 float-end btn-sm">
        {{ $products->links() }}
    </div>
</div>
