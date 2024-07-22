<div>
    @include('livewire.pages.admin.product.model-formproduct')
    @include('livewire.pages.admin.product.model-formrenew')

    @if (session('message'))
        <h3 class="alert alert-success">{{ session('message') }}</h3>
    @endif
    @if (session('delete'))
        <h3 class="alert alert-danger">{{ session('delete') }}</h3>
    @endif
    <div class="bg-light text-center rounded p-4">
        <div class="table-responsive">
            {{-- <a href="{{route('product_create')}}"
                class="btn btn-primary m-2 float-end mb-3">Add Product</a> --}}
            <input wire:model.live="search" style="margin-right: 100px;" type="text" placeholder="search model..."
                class="bg-gray-100 ml-2 rounded px-4 py-2 hover:bg-gray-100" />
            <label for="recordSelect" class="block text-sm font-medium text-gray-700">Record</label>
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
            <label class="w-40 text-sm font-medium text-gray-900">Category Type :</label>
            <select wire:model.live="selectedCategory" class="m-1"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="">All Categories</option>
                @foreach ($productcategories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
            <label class="w-40 text-sm font-medium text-gray-900">Brand Name :</label>
            <select wire:model.live="selectedBrand"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="">All Brand</option>
                @foreach ($productbrands as $brandname)
                    <option value="{{ $brandname->id }}">{{ $brandname->brand }}</option>
                @endforeach
            </select>
            <button type="button" onclick="printElement('tableproduct')" class="btn btn-primary"
                style="margin-left: 10px">Print</button>
            <hr>
            <div id="tableproduct">
                <div style="display: flex">
                    <h2 style="margin-top: 10px;margin-bottom:10px"> Product</h2>

                </div>
                @if (Auth::user()->role == 1)
                    {{-- <a href="#" wire:click="resetfield" data-bs-toggle="modal" data-bs-target="#addProductModal"
                        class="btn btn-primary m-2 float-end mb-3">Add Product</a> --}}
                @endif
                <table class="table  text-center text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th wire:click="toggleSort('id')">ID</th>
                            <th>ProductCategory</th>
                            <th>ProductBrand</th>
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
                            <th>Create_At</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $idCounter = ($products->currentPage() - 1) * $products->perPage() + 1;
                        @endphp

                        @foreach ($products as $product)
                            <tr>
                                {{-- This code uses the {{!! !!}} syntax to output raw HTML  --}}
                                <td>{{ $idCounter }}</td>
                                <td>{!! $product->productcategory->category_name ?? '<strong style="color: rgb(247, 92, 92);">N/A</strong>' !!}</td>
                                <td>{!! $product->productbrand->brand ?? '<strong style="color: rgb(247, 92, 92);">N/A</strong>' !!}</td>
                                <td>{!! empty($product->model) ? '<strong style="color: rgb(247, 92, 92);">N/A</strong>' : $product->model !!}</td>
                                <td>{{ $product->price }} $</td>
                                <td>{!! empty($product->gpu) ? '<strong style="color: rgb(247, 92, 92);">N/A</strong>' : $product->gpu !!}</td>
                                <td>{!! empty($product->cpu) ? '<strong style="color: rgb(247, 92, 92);">N/A</strong>' : $product->cpu !!}</td>
                                <td>{!! empty($product->ram) ? '<strong style="color: rgb(247, 92, 92);">N/A</strong>' : $product->ram !!}</td>


                                <td style="{{ $product->quantity < 3 ? 'background-color: #FFCCCC !important;' : '' }}">
                                    {{ $product->quantity }}
                                </td>
                                <td>{!! empty($product->color) ? '<strong style="color: rgb(247, 92, 92);" >N/A</strong>' : $product->color !!}</td>
                                <td>{!! empty($product->display) ? '<strong style="color: rgb(247, 92, 92);">N/A</strong>' : $product->display !!}</td>
                                <td>{{ $product->weight }} Kg</td>
                                <td>{!! empty($product->battery) ? '<strong style="color: rgb(247, 92, 92);" >N/A</strong>' : $product->battery !!}</td>
                                <td>{!! empty($product->official_warranty)
                                    ? '<strong style="color: red;" >N/A</strong>'
                                    : $product->official_warranty !!}</td>

                                <td><a href="{{ asset('storage/' . $product->image) }}" download><img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            style="height: 100px !important" alt="" class="img-fluid"></a></td>
                                <td>{!! empty($product->description) ? '<strong style="color: red;" >N/A</strong>' : $product->description !!}</td>
                                <td>{{ $product->created_at }}</td>
                                <td class="no-print">
                                   @if (Auth::user()->role == 1)
                                   <div style="gap: 5px ;" class="btn-group" role="group">
                                    <a style="border-radius:15px" type="" class="btn btn-warning"
                                        wire:click="editStockProduct({{ $product->id }})" data-bs-toggle="modal"
                                        data-bs-target="#addRenewModal">Renew</a>
                                    <a style="border-radius:15px" type="" class="btn btn-success"
                                        wire:click="editProduct({{ $product->id }})" data-bs-toggle="modal"
                                        data-bs-target="#editProductModal">Edit</a>
                                    <a style="border-radius:15px" type="" class="btn btn-danger"
                                        wire:click="deleteProduct({{ $product->id }})" data-bs-toggle="modal"
                                        data-bs-target="#deleteProductModal">Delete</a>
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
                {{ $products->links() }}
            </div>
        </div>

    </div>

    <!-- delete Laptop Modal -->
    <div wire:ignore.self class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyProduct">
                    <div class="modal-body">
                        <h6>Are you sure you want to delete this data?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Laptop Modal -->
    <div wire:ignore.self class="modal fade" id="editProductModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateProduct" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-light rounded h-100 p-4">
                        <div class="mb-3">
                            <select wire:model.defer="productcategory_id" id="" class="form-select mb-3">
                                <option value="">Select Product_Category</option>
                                @foreach ($productcategories as $productcategory)
                                    <option value="{{ $productcategory->id }}">
                                        {{ $productcategory->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('productcategory_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <select wire:model.defer="brand_id" id="" class="form-select mb-3">
                                <option value="">Select Product_Brand</option>
                                @foreach ($productbrands as $productbrand)
                                    <option value="{{ $productbrand->id }}">
                                        {{ $productbrand->brand }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" wire:model.defer="model" class="form-control" placeholder="Model">
                            @error('model')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" wire:model.defer="price" class="form-control" placeholder="Price">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <span class="input-group-text"> </span>
                            <input type="number" wire:model.defer="quantity" class="form-control"
                                placeholder="Quantity">
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" wire:model.defer="gpu" class="form-control" placeholder="GPU">
                            @error('gpu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <span class="input-group-text"> </span>
                            <input type="text" wire:model.defer="cpu" class="form-control" placeholder="CPU">
                            @error('cpu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" wire:model.defer="ram" class="form-control" placeholder="RAM">
                            @error('ram')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" wire:model.defer="color" class="form-control" placeholder="Color">
                            @error('color')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <span class="input-group-text"> </span>
                            <input type="text" wire:model.defer="display" class="form-control"
                                placeholder="Display">
                            @error('display')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" wire:model.defer="weight" class="form-control"
                                placeholder="Weight">
                            @error('weight')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <span class="input-group-text"> </span>
                            <input type="text" wire:model.defer="battery" class="form-control"
                                placeholder="Battery">
                            @error('battery')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" wire:model.defer="official_warranty" class="form-control"
                                placeholder="Official_Warranty">
                            @error('official_warranty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="file" id="image" wire:model="image" class="form-control">
                            <img src="{{ asset('storage') }}/{{ $old_image }}" alt=""
                                style="width: 90px;height: 90px;">
                            <input type="hidden" wire:model='old_image'>
                            @if ($image)
                                <br>
                                <span>Replace with</span>
                                <img class="rounded mt-3 d-block" src="{{ $image->temporaryUrl() }}" alt=""
                                    style="width: 90px;height: 90px;">
                            @endif
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <textarea type="text" wire:model.defer="description" class="form-control" placeholder="Description"> </textarea>
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



</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addProductModal').modal('hide');
        })
    </script>
    <script>
        window.addEventListener('close-modal', event => {
            $('#editProductModal').modal('hide');
        })
    </script>
    <script>
        window.addEventListener('close-modal', event => {
            $('#deleteProductModal').modal('hide');
        })
    </script>
    <script>
        window.addEventListener('close-modal', event => {
            $('#addRenewModal').modal('hide');
        })
    </script>

    <script>
        function printElement(elementId) {
            var printContent = document.getElementById(elementId).outerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
@endpush
