<div>

    <h3>Accessory List</h3>

    @if (session('message'))
        <h3 class="alert alert-success">{{ session('message') }}</h3>
    @endif

    <div class="bg-light text-center rounded p-4">
        <div class="table-responsive">
            <a href="#" data-bs-toggle="modal" data-bs-target="#addAccessoryModal"
                class="btn btn-primary m-2 float-end mb-3">Add Accessory</a>
                <input wire:model.live="search" style="margin-right: 100px" type="text" placeholder="search model..."
                class="bg-gray-100 ml-2 rounded px-4 py-2 hover:bg-gray-100" />
                    <label for="recordSelect" class="block text-sm font-medium text-gray-700">Record</label>
                <select wire:model.live="perPage"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            <table class="table text-start text-center align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>ID</th>
                        <th>Category_Name</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Official_Warranty</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accessorys as $accessory)
                        <tr>
                            <td>{{ $accessory->id }}</td>
                            <td>{{ $accessory->category->category_name }}</td>
                            <td>{{ $accessory->model }}</td>
                            <td>{{ $accessory->price }}</td>
                            <td style="{{ $accessory->quantity < 3 ? 'background-color: #FFCCCC !important;' : '' }}">
                                {{ $accessory->quantity }}
                            </td>
                            <td>{{ $accessory->official_warranty }}</td>
                            <td><a href="{{ asset('storage/' . $laptop->image) }}" download>
                                <img style="height: 120px !important;width:200px !important" src="{{ asset('storage/' . $accessory->image) }}" alt="" class="img-fluid"
                                    style="width: 90ox; height: 90px;"></a></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a type="" class="btn btn-success"
                                        wire:click="editAccessory({{ $accessory->id }})" data-bs-toggle="modal"
                                        data-bs-target="#editAccessoryModal">Edit</a>
                                    <a type="" class="btn btn-danger"
                                        wire:click="deleteAccessory({{ $accessory->id }})" data-bs-toggle="modal"
                                        data-bs-target="#deleteAccessoryModal">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2 float-end btn-sm">
                {{ $accessorys->links() }}
            </div>
        </div>
    </div>

    <!-- Add Accessory Modal -->
    <div wire:ignore.self class="modal fade" id="addAccessoryModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Laptop</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="storeAccessory" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-light rounded h-100 p-4">
                        <div class="mb-3">
                            <select wire:model.defer="category_id" id="" class="form-select mb-3">
                                <option value="">Select_Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" wire:model.defer="model" class="form-control" placeholder="Model">
                            @error('model')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" wire:model.defer="price" class="form-control" placeholder="Price">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="number" wire:model.lazy="quantity" class="form-control"
                                placeholder="Quantity">
                            @error('quantity')
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
                            <label for="formFile" class="form-label p-1">Image</label>
                            <input type="file" wire:model='image' accept="image/png image/jpeg" id="image"
                                class="ring-1 rign-inset ring-gray-300 bg-gray-100 text-gray-900 text-sm rounded block w-full form-control">
                            @error('image')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                            @if ($image)
                                <img class="rounded mt-3 d-block" src="{{ $image->temporaryUrl() }}" alt=""
                                    style="width: 90px;height: 90px;">
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Accessory Modal -->
    <div wire:ignore.self class="modal fade" id="editAccessoryModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Laptop</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateAccessory" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-light rounded h-100 p-4">
                        <div class="mb-3">
                            <select wire:model.defer="category_id" id="" class="form-select mb-3">
                                <option value="">Select_Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" wire:model.defer="model" class="form-control" placeholder="Model">
                            @error('model')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" wire:model.defer="price" class="form-control" placeholder="Price">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="number" wire:model.defer="quantity" class="form-control"
                                placeholder="Quantity">
                            @error('quantity')
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
                            <label for="formFile" class="form-label p-1">Image</label>
                            <input type="file" wire:model='image' accept="image/png image/jpeg" id="image"
                                class="ring-1 rign-inset ring-gray-300 bg-gray-100 text-gray-900 text-sm rounded block w-full form-control">
                            @error('image')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                            @if ($image)
                                <img class="rounded mt-3 d-block" src="{{ $image->temporaryUrl() }}" alt=""
                                    style="width: 90px;height: 90px;">
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete Accessory Modal -->
    <div wire:ignore.self class="modal fade" id="deleteAccessoryModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Laptop Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyAccessory">
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
            $('#addAccessoryModal').modal('hide');
        })
    </script>
    <script>
        window.addEventListener('close-modal', event => {
            $('#editAccessoryModal').modal('hide');
        })
    </script>
     <script>
        window.addEventListener('close-modal', event => {
            $('#deleteAccessoryModal').modal('hide');
        })
    </script>
@endpush
