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
                    <td>@if ($item->status=='confirm')
                        <p style="text-decoration: underline" >{{ $item->status }}</p>
                        @elseif ($item->status=='in progress')
                        <p  >{{ $item->status }}</p>
                    @endif</td>
                    <td>
                        <a type="button" href="{{ url('tracking/'.$item->id)}}"
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
