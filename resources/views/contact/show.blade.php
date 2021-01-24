@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card mx-5 mt-5 border-0 shadow-sm">
                <div class="card-body">
                    <form action="/contact" method="POST">
                        @csrf
                        <div class="form-group">
                            <p class="text-left">Email:</p>
                            <input id="my-input" class="form-control" type="email" name="email" >
                        </div>
                        <div class="form-group">
                            <p class="text-left">Body:</p>
                            <textarea id="my-textarea" class="form-control" style="resize: none"  name="body" rows="5"></textarea>
                        </div>
                        <button class="btn btn-dark" type="submit">Send Mail</button>
                    </form>
                    @if ($errors->any())
                    <div class=" mt-3 mb-0">
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item disabled text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(Session::has('msg'))
                        <ul class="list-group mt-3 mb-0">
                                <li class="list-group-item disabled text-success">{{ Session::get('msg') }}</li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
