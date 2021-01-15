@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card my-3">
                <div class="card-header">
                    Create a New Thread
                </div>
                <div class="card-body">
                <form method="post" action="/threads">
                    @csrf

                    <div class="form-group">
                        <label for="title">Channel:</label>
                        <select name="channel_id" id="" class="form-control" required>
                            <option value="">Choose one..</option>
                            @foreach (App\Models\Channel::all() as $channel)
                            <option value="{{$channel->id}}" {{old('channel_id') ==$channel->id ? 'selected' : ''}}>{{$channel->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('title')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input name="title" id="title" class="form-control" type="text" value="{{old('title')}}" required>
                    </div>
                    @error('title')
                    <p class="text-danger">{{$message}}</p>
                    @enderror


                    <div class="form-group">
                        <label for="body">Body:</label>
                        <textarea name="body" id="body" class="form-control"  rows="8" required>{{old('body')}}</textarea>
                    </div>
                    @error('body')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Publish</button>
                    </div>
                </form>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mb-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
