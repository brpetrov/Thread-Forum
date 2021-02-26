<div id="reply_{{$reply->id}}" class="card my-2">
    <div class="card-header d-flex justify-content-between">
        <div class="level">
            <a href="/profiles/{{$reply->owner->name}}">{{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}
        </div>
        <div class="d-flex justify-content-between">

            <form class="mx-1" action="/replies/{{$reply->id}}/favorites" method="POST">
                @csrf
                <button class="btn btn-secondary text-white " {{$reply->isFavorited() ? 'disabled' : ''}}>
                    <i class="far fa-thumbs-up"></i>  {{$reply->favorites_count}}
                </button>
            </form>
            @can('update', $reply)
                <form class="mx-1" method="POST" action="/replies/{{$reply->id}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                </form>
            @endcan
        </div>
    </div>
    <div class="card-body">
        <p>{{$reply->body}}</p>
    </div>
</div>
