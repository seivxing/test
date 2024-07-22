<div>
    <span>
        @if ($userName == 0)
            USER
        @elseif ($userName == 1)
            ADMIN
        @elseif ($userName == 2)
            SALE
        @else
            {{ $UserName }}
        @endif
    </span>
</div>
