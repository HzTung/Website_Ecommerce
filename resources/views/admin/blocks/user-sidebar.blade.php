<div class="p-3">

    <div class="input-group rounded mb-3">
        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
            aria-describedby="search-addon" />
        <span class="input-group-text border-0" id="search-addon">
            <i class="fas fa-search"></i>
        </span>
    </div>

    <div data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">
        <ul class="list-unstyled mb-0">
            @foreach ($listUsers as $user)
                <li class="p-2 border-bottom">
                    <a href="{{ route('chat.private', $user->id) }}" class="d-flex justify-content-between">
                        <div class="d-flex flex-row">
                            <div class="pt-1">
                                <p class="fw-bold mb-0">{{ $user->name }}</p>
                                @php
                                    $sort = [Auth::guard('admin')->user()->id, $user->id];
                                    sort($sort);
                                    $channel = implode('-', $sort);
                                    $user_sent = $allMsg->where('room_name', $channel)->sortByDesc('sent_at')->first()
                                        ->user_id;

                                @endphp
                                <p id ="textBox-{{ $channel }}" class="small text-muted">
                                    @if ($user_sent == Auth::guard('admin')->user()->id)
                                        You:
                                        {{ $allMsg->where('room_name', $channel)->sortByDesc('sent_at')->first()->message_text }}
                                </p>
                            @else
                                {{ $allMsg->where('room_name', $channel)->sortByDesc('sent_at')->first()->message_text }}
            @endif
    </div>
</div>
<div class="pt-1">
    @if ($user->status == 'online')
        <p id="" class="small  text-success mb-1 notification-{{ $user->id }}">
            online</p>
    @else
        <p id="" class="small text-muted  mb-1 notification-{{ $user->id }}">
            offline</p>
    @endif
</div>
</a>
</li>
@endforeach
</ul>
</div>

</div>
