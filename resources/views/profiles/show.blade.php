@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron p-4 bg-light">
        <h1 class="display-5">{{$profileUser->name}}</h1>
        <hr class="my-4">
        <p>Registered {{$profileUser->created_at->diffForHumans()}}</p>
        <a class="btn btn-primary btn-lg" href="#" role="button">Follow</a>
      </div>

      @foreach ($activities as $date=>$activity)
        <div class="p-3 bg-primary text-white rounded ">
          <h4>{{$date}}</h4>
        </div>
      @foreach ($activity as $record)
      @include("profiles.activities.{$record->type}",['activity'=>$record])

      @endforeach
      @endforeach

      {{-- {{$threads->links('pagination::bootstrap-4')}} --}}
</div>


@endsection
