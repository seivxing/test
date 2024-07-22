<div>

    <div class="py-3 py-md-5">
        <div class="container">
            <h4>My Cart</h4>
            <hr>
            @if (session('error'))
                <h3 class="alert alert-danger">{{ session('error') }}</h3>
            @endif
            @if (session('message'))
                <h3 class="alert alert-success">{{ session('message') }}</h3>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart" wire:poll.keep-alive.4s>

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Sub Total</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse ($cart as $cartitem)
                            @if ($cartitem->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-4 my-auto">
                                            <a href="{{ url('viewdetail/product/' . $cartitem->product->model) }}">
                                                <label class="product-name">
                                                    <img src="{{ asset('storage/' . $cartitem->product->image) }}"
                                                        class="mr-3" style="height: 100px !important" alt="">
                                                    {{ $cartitem->product->model }}
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price">$ {{ $cartitem->product->price }} </label>
                                        </div>
                                        <div class="col-md-2 col-7 my-auto">
                                            <div class="quantity">
                                                <div class="input-group">
                                                    @if ($cartitem->quantity > 1)
                                                        <button type="button" class="btn btn1"
                                                            wire:loading.attr="disabled"
                                                            wire:click="decrementQuantity({{ $cartitem->id }})"><i
                                                                class="fa fa-minus"></i></button>
                                                    @else
                                                    @endif
                                                    <input type="text" value="{{ $cartitem->quantity }}" readonly
                                                        class="input-quantity" />
                                                    <button type="button" class="btn btn1" wire:loading.attr="disabled"
                                                        wire:click="incrementQuantity({{ $cartitem->id }})"><i
                                                            class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price">$ {{ $cartitem->product->price * $cartitem->quantity }}
                                            @php $totalPrice += $cartitem->product->price * $cartitem->quantity  @endphp
                                            </label>
                                        </div>
                                        <div class="col-md-2 col-5 my-auto">
                                            <div class="remove">
                                                <button type="button" wire:loading.attr="disabled"
                                                    wire:click="removeCartItem( {{ $cartitem->id }} )"
                                                    class="btn btn-danger btn-sm">
                                                    <span wire:loading.remove
                                                        wire:target="removeCartItem( {{ $cartitem->id }} )">
                                                        <i class="fa fa-trash"></i> Remove
                                                    </span>
                                                    <span wire:loading
                                                        wire:target="removeCartItem( {{ $cartitem->id }} )">
                                                        <i class="fa fa-trash"></i> Removing
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            No Cart Item available
                        @endforelse


                    </div>
                </div>
            </div>
            @if ($totalPrice)
            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h5>
                        <a href="{{ route('home') }}">shopping more</a>
                    </h5>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p3">
                        <h4>Total:
                            <span class="float-end">$ {{ $totalPrice }} </span>
                        </h4>
                        <hr>
                        <a href="{{ route('checkout_product') }}" class="btn btn-warning w-100">CheckOut</a>
                    </div>
                </div>
            </div>
            @else

            @endif
        </div>
    </div>
</div>
