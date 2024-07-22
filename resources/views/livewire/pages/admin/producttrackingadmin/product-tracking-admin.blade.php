<div wire:poll.keep-alive.7s>
    <style>
        .confirm {
            background-color: #4CAF50;
            /* Change background color as desired */
            color: white;
            padding: 8px 16px;
            /* Adjust padding for slimmer look */
            border: none;
            border-radius: 4px;
            /* Add some rounded corners */
            cursor: pointer;
            display: inline-block;
            font-size: 15px;
            font-family: cursive;
            font-style: italic
                /* Adjust font size if needed */
        }

        .inprogress {
            background-color: #d89134;
            /* Change background color as desired */
            color: white;
            padding: 8px 16px;
            /* Adjust padding for slimmer look */
            border: none;
            border-radius: 4px;
            /* Add some rounded corners */
            cursor: pointer;
            display: inline-block;
            font-size: 15px;
            font-family: cursive;
            font-style: italic
                /* Adjust font size if needed */
        }

        .cancel {
            background-color: #f76767;
            /* Change background color as desired */
            color: white;
            padding: 8px 16px;
            /* Adjust padding for slimmer look */
            border: none;
            border-radius: 4px;
            /* Add some rounded corners */
            cursor: pointer;
            display: inline-block;
            font-size: 15px;
            font-family: cursive;
            font-style: italic
        }
    </style>
    <div>

        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" wire:model.live="startDate" class="form-control">
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" wire:model.live="endDate" class="form-control">
        <hr>
        @if (session('error'))
            <h3 class="alert alert-danger">{{ session('error') }}</h3>
        @endif
        @if (session('delete'))
            <h3 class="alert alert-danger">{{ session('delete') }}</h3>
        @endif
    </div>
    <label>Record: </label>
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
    <button type="button" class="btn btn-primary" style="margin-left: 10px"
        onclick="printElement('tabletracking')">Print</button>
    <div id="tabletracking">
        <div style="display: flex">
            <h2 style="margin-top: 10px;margin-bottom:10px">Order Product</h2>
        </div>
        <div>Period {{ $startDate }} to {{ $endDate }} </div>
        <table class="table text-start text-center align-middle table-bordered table-hover mb-0">

            <thead>
                <tr class="text-dark">
                    <th>ID </th>
                    <th>User Name</th>
                    <th>Order Date</th>
                    <th>Status Message</th>
                    <th>Payment Image</th>
                    <th>Total_Amount</th>
                    <th class="no-print">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $idCounter = 1; // Initialize a counter variable
                @endphp
                @forelse ($orders as $item)
                    <tr>
                        <td>{{ $idCounter }}</td>
                        <td>{{ $item->full_name }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>
                            @if ($item->status == 'confirm')
                                <button class="confirm">Confirm</button>
                            @elseif ($item->status == 'cancel')
                                <button class="cancel">Cancel</button>
                            @else
                                <button class="inprogress"
                                    onclick=" confirm('Are you sure?') || event.stopImmediatePropagation()"
                                    wire:click="markOrderReturned({{ $item->id }})"> In progress</button>
                                <br>
                                <button class="cancel mt-2"
                                    onclick=" confirm('Are you sure to cancel?') || event.stopImmediatePropagation()"
                                    wire:click="cancelOrder({{ $item->id }})">Cancel</button>
                            @endif

                        </td>
                        <td><a href="{{ asset('storage/' . $item->payment_qr) }}" download>
                                <img style="height: 120px !important;width:200px !important"
                                    src="{{ asset('storage/' . $item->payment_qr) }}" alt=""
                                    class="img-fluid"></a>
                        </td>
                        <td>{{ $item->total_amount }} $</td>
                        <td class="no-print">
                            @if (Auth::user()->role == 1)
                                <a type="button" href="{{ route('trackingproductadmin', ['orderId' => $item->id]) }}"
                                    class="btn btn-primary btn-sm">View</a>
                            @endif
                            @if (Auth::user()->role == 2)
                                <a type="button"
                                    href="{{ route('trackingproductadmin_sale', ['orderId' => $item->id]) }}"
                                    class="btn btn-primary btn-sm">View</a>
                            @endif
                        </td>
                    </tr>
                    @php
                        $idCounter++;
                    @endphp
                @empty
                    <tr>
                        <td colspan="4">No Orders available</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    {{-- <div class="mt-2 btn-sm">
        {{ $orders->links() }}
    </div> --}}

</div>
@push('script')
    <script>
        function printElement(elementId) {
            var printContents = document.getElementById(elementId).outerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endpush
