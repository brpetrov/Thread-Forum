@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-11">
            @foreach ($threads as $thread)
            <div class="card my-3">
                <div class="card-header">
                    <h5>{{$thread->title}}</h5>
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
