<div>

    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Checkout</h4>
            <hr>

            @if ($this->totalLaptopAmount != '0')
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Total Amount :
                                <span class="float-end">$ {{ $this->totalLaptopAmount }}</span>
                            </h4>
                            <hr>
                            <small>* Items will be delivered in 2 - 3 days.</small>
                            <br />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Information Payment
                            </h4>
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
                            <hr>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Full Name</label>
                                    <input type="text" wire:model.defer='fullname' readonly class="form-control"
                                        placeholder="Enter Full Name" />
                                    @error('fullname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone Number</label>
                                    <input type="number" wire:model.defer='phonenumber' class="form-control"
                                        placeholder="Enter Phone Number" />
                                    @error('phonenumber')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Full Address</label>
                                    <textarea wire:model.defer="address" class="form-control" rows="2"></textarea>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <hr>
                                <div class="col-md-6 mb-3">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label p-1">Upload QR</label>
                                        <input type="file" wire:model.defer='payment_qr' accept="image/png image/jpeg"
                                            id="payment_qr" class="form-control">
                                        @error('payment_qr')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label p-1">Pay Now</label>
                                        <br>
                                        <img src=" {{ asset('bs5/img/ROC-Merchandise-QR-Code-658x1024.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="button" wire:click="codOrder" class="btn btn-primary">Place Order</button>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            @else
            <div class="card card-body shadow text-center p-md-5 ">
                <h4>NO Items in cart to checkout</h4>
                <a href="{{ route('home') }}" class="btn btn-primary">Shop Now</a>
            </div>
            @endif
        </div>
    </div>
</div>
