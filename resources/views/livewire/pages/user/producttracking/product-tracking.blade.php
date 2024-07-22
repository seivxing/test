<div>


    <div wire:poll.keep-alive.2s>
        <table class="table text-start text-center align-middle table-bordered table-hover mb-0">
            <thead>
                <tr class="text-dark">
                    <th>User Name</th>
                    <th>Oder Date</th>
                    <th>Status Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $item)
                    <tr>
                        <td>{{ $item->full_name }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>

                        <td>
                            @if ($item->status == 'confirm')

                             The order is <span  style="   color:rgb(123, 248, 92); font-weight:bold">confirm</span>
                            @elseif ($item->status == 'in progress')
                            The order is <span  style="   color:rgb(91, 213, 250); font-weight:bold">in progress</span>
                            @elseif($item->status == 'cancel')
                            The order is <span style="text-decoration: underline;   color:red; font-weight:bold">cancel</span>(Click View for more detail)
                            @endif
                        </td>
                        <td>
                            <a type="button" href="{{ url('trackingproduct/' . $item->id) }}"
                                class="btn btn-primary btn-sm">View</a>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No Orders available</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>


</div>
