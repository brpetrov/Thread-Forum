@component('profiles.activities.activity')
@slot('heading')
{{$profileUser->name}} <a href="{{$activity->subject->favorited->path()}}">&nbsp; has favorited a reply</a>
@endslot

@slot('body')
{{$activity->subject->favorited->body}}
@endslot
@endcomponent
