<div class="card my-2">
    <div class="card-header"><span class="text-primary">{{$reply->user->name}}</span> said {{$reply->created_at->diffForHumans()}}</div>
    <div class="card-body">
        <p>{{$reply->body}}</p>
    </div>
</div>
