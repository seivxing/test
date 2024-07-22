<!-- Add Laptop Modal -->
<div wire:ignore.self class="modal fade" id="addProductModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="storeProduct" enctype="multipart/form-data">
                @csrf
                <div class="bg-light rounded h-100 p-4">
                    <div class="mb-3">
                        <select wire:model.defer="productcategory_id" id="" class="form-select mb-3">
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
                        <select wire:model.defer="brand_id" id="" class="form-select mb-3">
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
                        <input type="number" wire:model.lazy="quantity" class="form-control" placeholder="Quantity">
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
                        <span class="input-group-text"> </span>
                        <input type="text" wire:model.defer="ram" class="form-control" placeholder="RAM">
                        @error('ram')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" wire:model.defer="color" class="form-control" placeholder="Color" required>
                        @error('color')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <span class="input-group-text"> </span>
                        <input type="text" wire:model.defer="display" class="form-control" placeholder="Display">
                        @error('display')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" wire:model.defer="weight" class="form-control" placeholder="Weight">
                        @error('weight')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <span class="input-group-text"> </span>
                        <input type="text" wire:model.defer="battery" class="form-control" placeholder="Battery">
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
                        <label for="formFile" class="form-label p-1">Image</label>
                        <input type="file" wire:model='image' accept="image/png image/jpeg" id="image" required
                            class="ring-1 rign-inset ring-gray-300 bg-gray-100 text-gray-900 text-sm rounded block w-full form-control">
                        @error('image')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                        @if ($image)
                        <img class="rounded mt-3 d-block" src="{{ $image->temporaryUrl() }}" alt="" style="width: 90px;height: 90px;">
                        @endif
                    </div>
                    <div class="mb-3">
                        <textarea type="text" wire:model.defer="description" class="form-control" placeholder="Description"> </textarea>
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
