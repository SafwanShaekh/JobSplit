<div wire:poll.5s>
    @if($count > 0)
        <span class="notification-pulse-badge">
            {{ $count }}
        </span>
    @endif
</div>