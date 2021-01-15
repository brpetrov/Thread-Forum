@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach ($threads as $thread)
            <div class="card my-3">
                <div class="card-header">
                    <a href="{{$thread->path()}}"><h5>{{$thread->title}}</h5></a>
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
