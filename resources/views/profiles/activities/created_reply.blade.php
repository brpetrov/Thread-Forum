@component('profiles.activities.activity')
@slot('heading')
{{$profileUser->name}} replied to<a href="{{$record->subject->thread->path()}}">&nbsp;{{$record->subject->thread->title}}</a>
@endslot

@slot('body')
{{$record->subject->body}}
@endslot
@endcomponent
