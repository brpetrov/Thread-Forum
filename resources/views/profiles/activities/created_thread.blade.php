@component('profiles.activities.activity')
@slot('heading')
{{$profileUser->name}} created a thread: <a href="{{$record->subject->path()}}">{{$record->subject->title}}</a>
@endslot

@slot('body')
{{$record->subject->body}}
@endslot
@endcomponent
