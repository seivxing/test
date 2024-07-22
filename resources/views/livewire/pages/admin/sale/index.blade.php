<div>
    <div class="row">
        <div class="col-lg-8">
            @if (session('error'))
                <h3 class="alert alert-danger">{{ session('error') }}</h3>
            @endif
            @if (session('message'))
                <h3 class="alert alert-success">{{ session('message') }}</h3>
            @endif
            <div class="shadow">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    @foreach ($products as $product)
                        <div class="col">
                            <!-- Card-->
                            <div class="card rounded border-0">
                                <div class="card-body p-4">
                                    <div class="bg-white border">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Img"
                                            style="width: 100%;height: 15vw;">
                                    </div>
                                    <hr>
                                    <p class="text-dark mb-0"><strong>CATEGORY:</strong>
                                        {{ $product->productcategory->category_name }}</p>
                                    <p class="text-dark mb-0"><strong>BRAND:</strong>
                                        {{ $product->productbrand->brand }}
                                    </p>
                                    <p class="text-dark mb-0"><strong>MODEL:</strong> {{ $product->model }}</p>
                                    <p class="text-dark mb-0"><strong>Price:</strong> {{ $product->price }}$</p>
                                    <p class="text-muted small mb-0"><strong>CPU:</strong> {{ $product->cpu }}</p>
                                    <p class="text-primary small mb-0"><strong>GPU:</strong> {{ $product->gpu }}</p>
                                    <p class="text-dark mb-0"><strong>RAM:</strong>{{ $product->ram }}</p>
                                    <p class="text-muted small mb-0"><strong>WARRANTY
                                            YEARS</strong>{{ $product->official_warranty }}
                                    </p>

                                    <div class="d-flex justify-content-center mt-3">
                                        <div class="mt-2">
                                            @if ($product->quantity >= 1)
                                                <button type="button" wire:click="addToCard({{ $product->id }})"
                                                    class="btn btn1 btn-primary">
                                                    <i class="fa fa-shopping-cart"></i> Add
                                                </button>
                                            @else
                                                <button type="button" class="btn btn1 btn-danger" disabled>
                                                    <i class="fa fa-shopping-cart"></i> Out of Stock
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="p-2">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        <div class="col-4" wire:poll.keep-alive.4s>
            <div class="shadow p-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Sub Total</th>
                            <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($cart as $cartitem)
                            @if ($cartitem->product)
                                <tr>
                                    <td>{{ $cartitem->product->model }}</td>
                                    <td>$ {{ $cartitem->product->price }}</td>
                                    <td>
                                        @if ($cartitem->quantity > 1)
                                            <button type="button" class="btn btn1" wire:loading.attr="disabled"
                                                wire:click="decrementQuantity({{ $cartitem->id }})"><i
                                                    class="fa fa-minus"></i></button>
                                        @else
                                        @endif
                                        {{ $cartitem->quantity }}
                                        <button type="button" class="btn btn1" wire:loading.attr="disabled"
                                            wire:click="incrementQuantity({{ $cartitem->id }})"><i
                                                class="fa fa-plus"></i></button>
                                    </td>
                                    <td>
                                        $ {{ $cartitem->product->price * $cartitem->quantity }}
                                        @php $totalPrice += $cartitem->product->price * $cartitem->quantity  @endphp
                                    </td>
                                    <td>
                                        <button type="button" wire:loading.attr="disabled"
                                            wire:click="removeCartItem( {{ $cartitem->id }} )"
                                            class="btn btn-danger btn-sm">
                                            <span wire:loading.remove
                                                wire:target="removeCartItem( {{ $cartitem->id }} )">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                            <span wire:loading wire:target="removeCartItem( {{ $cartitem->id }} )">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <h5 class="p-4"> No Cart Item available</h5>
                        @endforelse

                    </tbody>
                </table>

                @if ($totalPrice)
                    <div class="mb-3">
                        <input type="text" wire:model.defer="name" class="form-control" placeholder="Name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" wire:model.defer="phone" class="form-control" placeholder="Phone">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <div class="shadow-sm bg-white p3">
                                <h4 style="width: 200px">Total:
                                    <span>$ {{ $totalPrice }} </span>
                                </h4>
                                <hr>
                                <div class="col-md-12 mb-3">
                                    <button type="button" wire:click="codOrder" class="btn btn-primary">Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                @endif
            </div>
        </div>
    </div>
</div>
