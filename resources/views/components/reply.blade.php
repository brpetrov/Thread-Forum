<div class="card my-2">
    <div class="card-header d-flex justify-content-between">
        <div class="level">
            <a href="#">{{$reply->user->name}}</a> said {{$reply->created_at->diffForHumans()}}
        </div>
        <div>

            <form action="/replies/{{$reply->id}}/favorites" method="POST">
                @csrf
                <button class="btn btn-primary text-white rounded-circle" {{$reply->isFavorited() ? 'disabled' : ''}}>
                    {{$reply->favorites->count()}}
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <p>{{$reply->body}}</p>
    </div>
</div>
