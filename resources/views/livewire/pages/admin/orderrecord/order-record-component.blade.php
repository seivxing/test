<div>
    <h1>Order Record</h1>
    <table class="table text-start text-center align-middle table-bordered table-hover mb-0">
        <thead>
            <tr class="text-dark">
                <th colspan="5">
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" wire:model.live="startDate" class="form-control">
                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" wire:model.live="endDate" class="form-control">
                </th>
            </tr>
            <tr class="text-dark">
                <th>Product ID:</th>
                <th>Model</th>
                <th>Price</th>
                <th>Total Quantity:</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productQuantities as $productQuantity)
                @if ($productQuantity->product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $productQuantity->product->model }}</td>
                        <td>{{ $productQuantity->product->price }} $</td>
                        <td>{{ $productQuantity->total_quantity }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>

        {{-- <tbody>

            @foreach ($productQuantities as $productQuantity)
                @if ($productQuantity->product)
                    <tr>
                        <td>{{ $productQuantity->product->id }}</td>
                        <td>{{ $productQuantity->product->model }}</td>
                        <td>{{ $productQuantity->product->price }}</td>
                        <td>{{ $productQuantity->total_quantity }}</td>

                    </tr>
                @endif
            @endforeach

        </tbody> --}}
    </table>
</div>
