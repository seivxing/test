
<div wire:ignore.self class="modal fade" id="addRenewModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Renew Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="storeRenewStockProduct" enctype="multipart/form-data">
                @csrf
                <div class="bg-light rounded h-100 p-4">

                    {{-- <div class="mb-3">
                            <select wire:model.defer="product_id" wire:change="updateModel" id="" class="form-select mb-3">
                            <option value="">Select_ProductId</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->id }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    {{-- <div class="mb-3">

                        <input  type="text" wire:model.lazy="model"  class="form-control"  >

                        @error('model')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <div class="mb-3">
                        <input type="number" wire:model.defer="renewquantity" class="form-control" placeholder="Quantity">
                        @error('quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="number" wire:model.defer="renewprice" class="form-control" placeholder="Price">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
