<div>
    <h3>General Setting</h3>
    @if (session('message'))
        <div class="alert alert-success">
            <h3 wire:ignore.self>{{ session('message') }}</h3>
            <!-- Add a close button to hide the message -->

        </div>
    @endif


    <form wire:submit.prevent="updateSetting" enctype="multipart/form-data">
        @csrf
        <div class="bg-light rounded h-20 p-4 shadow">
            <div class="form-group">
                <label for="app_name">App Name</label>
                <input type="text" wire:model.defer="app_name" class="form-control ">
                @error('app_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="title_name">Title Name</label>
                <input type="text" wire:model.defer="title_name" class="form-control">
                @error('title_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="image">Icon</label>
                <input type="file" wire:model.defer="image" class="form-control ">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">SaveChange</button>
            </div>
        </div>
    </form>
    <div style="width: 100%; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
        {{-- Temp file  --}}
        <div style="margin-bottom: 20px;">
            <p style="font-size: 18px; color: #333; font-family: 'Cursive';" wire:poll>Total size of livewire-tmp
                folder: {{ $totalSize }}</p>

            <button wire:click="calculateTotalSize"
                style="margin-right: 10px; padding: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 5px;">Recalculate
                Size</button>
            <button wire:click="deleteLivewireTmpFiles"
                onclick="return confirm('Are you sure you want to deleted the temp file ?')"
                style="padding: 10px; background-color: #dc3545; color: #fff; border: none; border-radius: 5px;">Delete
                Theme file </button>
        </div>
        {{-- Export Database  --}}
        <div>
            <h3>Export Database:</h3>
            <button wire:click="export" class="btn btn-primary"
                style="padding: 10px; background-color: #28a745; color: #fff; border: none; border-radius: 5px;">Export
                Database</button>
            <!-- resources/views/livewire/database-importer.blade.php -->
            <br>
            <br>
            <br>

            <div>
                <form wire:submit.prevent="importDatabase">
                    <div class="mb-4">
                        <label for="sqlFile" class="block text-gray-700 font-bold mb-2">Upload SQL File:</label>
                        <input type="file" id="sqlFile" wire:model="sqlFile" class="border rounded p-2">
                        @error('sqlFile')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded btn btn-primary">
                        Import Database
                    </button>
                </form>

                {{-- @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @php
                        session()->forget('success');
                    @endphp
                @endif --}}

                <div>
                    @foreach ($flashMessages as $flashMessage)
                        <div class="alert alert-{{ $flashMessage['type'] }}">
                            {{ $flashMessage['message'] }}
                        </div>
                    @endforeach
                </div>



            </div>




        </div>
    </div>

    <h1>Payment Image Setting</h1>

    <table class="table text-center text-start align-middle table-bordered table-hover mb-0">
        <thead>
            <tr class="text-dark">
                <th>id</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($qrcode as $qrcode)
                <tr>
                    <td>1</td>
                    <td><a href="{{ asset('storage/' . $qrcode->images) }}" download><img
                                src="{{ asset('storage/' . $qrcode->images) }}" style="height: 100px !important"
                                alt="" class="img-fluid" /></a></td>
                    <td>
                        <a class="btn btn-success btn-sm" style="gap:5px" type=""
                            wire:click='editProduct({{ $qrcode->id }})' data-bs-toggle="modal"
                            data-bs-target="#editQrModal" href="#">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm btn-dele"
                            wire:click="deleteQr({{ $qrcode->id }})" data-bs-toggle="modal"
                            data-bs-target="#deleteQrModal">Delete</a>
                    </td>
                </tr>

            @empty
                <a class="btn btn-primary my-2 py-2" href="#" data-bs-toggle="modal"
                    data-bs-target="#addQrModal">Add Qr Image</a>
            @endforelse
        </tbody>
    </table>


    {{-- Add New Qr Image  --}}
    <div wire:ignore.self class="modal fade" id="addQrModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Qr Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='storeQrImage' enctype="multipart/form-data">
                    @csrf
                    <div class="bg-light rounded h-100 p-4">

                        <div class="mb-3">
                            <label for="formFile" class="form-lable p-1">Image</label>
                            <input type="file" wire:model='images' accept="image/png image/jpeg" id="images"
                                required
                                class="ring-1 rign-inset ring-gray-300 bg-gray-100 text-gray-900 text-sm rounded block w-full form-control">
                            @error('images')
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

    {{-- Edit Image --}}
    <div wire:ignore.self class="modal fade" id="editQrModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Qr Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form wire:submit.prevent='updateQr' enctype="multipart/form-data">
                    @csrf
                    <div class="bg-light rounded h-100 p-4">
                        <div class="mb-3">
                            <label for="formFile" class="form-label p-1">Image</label>
                            <input type="file" wire:model='images' accept="image/png image/jpeg" id="images"
                                class="ring-1 rign-inset ring-gray-300 bg-gray-100 text-gray-900 text-sm rounded block w-full form-control"
                                required>
                            @error('images')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    {{-- Delete Qr Image --}}
    <div wire:ignore.self class="modal fade" id="deleteQrModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Image Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='destroyQr'>
                    <div class="modal-body">
                        <h6>Are you sure you want to delete the Qr code image(payment) ? </h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addQrModal').modal('hide');
        })
    </script>
    <script>
        window.addEventListener('close-modal', event => {
            $('#editQrModal').modal('hide');
        })
    </script>

    <script>
        window.addEventListener('close-modal', event => {
            $('#deleteQrModal').modal('hide');
        })
    </script>
@endpush
