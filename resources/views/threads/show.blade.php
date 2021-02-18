@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5><a href="/profiles/{{$thread->creator->name}}">{{$thread->creator->name}}</a> posted: {{$thread->title}}</h5>
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
                                <label for="body" class="h6">Add a Reply</label>
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
                        <h5><a href="/profiles/{{$thread->creator->name}}">{{$thread->creator->name}}</a> posted: {{$thread->title}}</h5>
                    </div>
                    <div class="card-body ">
                        <p>This thread was published {{$thread->created_at->diffForHumans()}}</p>
                        <p>by {{$thread->creator->name}}</p>
                        <p> {{$thread->replies_count}} {{Str::plural('comment'),$thread->replies_count}}</p>
                        @can('update',$thread)
                        <div class="text-right my-n2">
                            <form action="{{$thread->path()}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-n3 mr-n2" type="button">Delete</button>
                            </form>
                        </div>
                        @endcan

                    </div>
                    </div>
            </div>
        </div>
</div>
@endsection
