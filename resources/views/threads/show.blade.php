@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5><a href="#">{{$thread->user->name}}</a> posted: {{$thread->title}}</h5>
                </div>
                <div class="card-body">
                    <article>
                        <p>{{$thread->body}}</p>
                    </article>
                </div>
                </div>
                <div class="row justify-content-center my-4">
                    <div class="col-md-12">

                @auth

                        <form class="w-100" method="POST" action="{{$thread->path().'/replies'}}">
                            @csrf
                            <div class="form-group text-center">
                                <label for="exampleFormControlTextarea1" class="h6">Add a Reply</label>
                                <textarea name="body" class="form-control" rows="4" placeholder="something to say?"></textarea>
                                <button class="btn btn-primary my-2 px-4" type="submit">Post</button>
                              </div>
                        </form>

                @endauth

                @guest
                    <h5 class="my-3 text-center">Please sign in to participate in this discussion: <a href="{{route('login')}}">Sign In</a></h5>
                @endguest
            </div>
            </div>

                @foreach ($thread->replies as $reply)
                    @include('components.reply')
                @endforeach

                {{$replies->links('pagination::bootstrap-4')}}


            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5><a href="#">{{$thread->user->name}}</a> posted: {{$thread->title}}</h5>
                    </div>
                    <div class="card-body">
                        <p>This thread was published {{$thread->created_at->diffForHumans()}}</p>
                        <p>by {{$thread->user->name}}</p>
                        <p> {{$thread->replies()->count()}} {{Str::plural('comment'),$thread->replies()->count()}}</p>
                    </div>
                    </div>
            </div>
        </div>
</div>
@endsection
