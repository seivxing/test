<div>
    <div class="py-3 py-md-5">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-100 h-100" alt="Img">
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->model }}
                            <label class="label-stock bg-success">In Stock</label>
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / Category / product/ {{ $product->model }}
                        </p>
                        <div>
                            <span class="selling-price">${{ $product->price }}</span>
                            <p class="text-dark mb-0"><strong>MODEL:</strong> {{ $product->model }}</p>
                            <p class="text-dark mb-0"><strong>Color:</strong> {{ $product->color }}</p>
                            <p class="text-dark mb-0"><strong>Price:</strong> {{ $product->price }}$</p>
                            <p class="text-dark mb-0"><strong>CPU:</strong> {{ $product->gpu }}</p>
                            <p class="text-dark mb-0"><strong>GPU:</strong> {{ $product->gpu }}</p>
                            <p class="text-dark mb-0"><strong>RAM:</strong>{{ $product->ram }}</p>
                            <p class="text-dark mb-0"><strong>WARRANTY
                                    YEARS:</strong>{{ $product->official_warranty }}
                                {{-- <span class="original-price">$499</span> --}}
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:click="quantityCount" value="{{ $this->quantityCount }}"
                                    readonly class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCard({{ $product->id }})" class="btn btn1">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>
                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> Add To Wishlist </a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p style="color:black">
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
