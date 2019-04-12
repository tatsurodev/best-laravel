<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <img class="rounded-circle" src="{{ Gravatar::src($discussion->author->email) }}"
                style="height: 40px; width: 40px;">
            <span class="ml-2 font-weight-bold">{{ $discussion->author->name }}</span>
        </div>
        <div>
            <a href="{{ route('discussions.show', $discussion->slug) }}" class="btn btn-success btn-sm">View</a>
        </div>
    </div>
</div>
