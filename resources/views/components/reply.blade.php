<div class="card my-2">
    <div class="card-header d-flex justify-content-between">
        <div class="level">
            <a href="/profiles/{{$reply->owner->name}}">{{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}
        </div>
        <div>

            <form action="/replies/{{$reply->id}}/favorites" method="POST">
                @csrf
                <button class="btn btn-secondary text-white " {{$reply->isFavorited() ? 'disabled' : ''}}>
                    <i class="far fa-thumbs-up"></i>  {{$reply->favorites_count}}
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <p>{{$reply->body}}</p>
    </div>
</div>
