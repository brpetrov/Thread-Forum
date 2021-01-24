@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach ($threads as $thread)
            <div class="card my-3">
                <div class="card-header">
                    <div class="d-flex flex-row">
                        <a class="d-inline" href="{{$thread->path()}}"><h5 class="flex">{{$thread->title}}</h5></a>
                        <a href="{{$thread->path()}}" class="ml-auto">{{$thread->replies_count}} {{Str::plural('reply',$thread->replies()->count())}}</a>
                    </div>

                </div>
                <div class="card-body">
                    <article>
                        <p>{{$thread->body}}</p>
                    </article>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
