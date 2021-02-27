<reply :attributes="{{$reply}}" inline-template v-cloak>
<div id="reply_{{$reply->id}}" class="card my-2">
    <div class="card-header d-flex justify-content-between">
        <div class="level">
            <a href="/profiles/{{$reply->owner->name}}">{{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}
        </div>
        <div class="d-flex justify-content-between">

            <form class="mx-1" action="/replies/{{$reply->id}}/favorites" method="POST">
                @csrf
                <button class="btn btn-info text-white " {{$reply->isFavorited() ? 'disabled' : ''}}>
                    <i class="far fa-thumbs-up"></i>  {{$reply->favorites_count}}
                </button>
            </form>
            @can('update', $reply)

            <div class="dropdown">
                <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cog"></i>
                </button>

                <div class="dropdown-menu text-center px-0" aria-labelledby="dropdownMenuButton">
                  <div class="dropdown-item mx-0 px-0">
                    <form class="mx-1" method="POST" action="/replies/{{$reply->id}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                    </form>
                  </div>
                  <div class="dropdown-item mx-0 px-0">
                        <button @click="editing = true" class="btn btn-info" type="submit"><i class="fas fa-edit"></i></button>
                  </div>
                </div>
              </div>


            @endcan
        </div>
    </div>
    <div class="card-body">
        <div v-if="editing">
            <div class="form-group">
                <textarea v-model='body' class="form-control" rows="3"></textarea>
            </div>
            <button @click="update" class="btn btn-primary" type="button">Update</button>
            <button @click="editing = false" class="btn btn-secondary" type="button">Cancel</button>
        </div>
        <div v-else>
            <p v-text='body'></p>
        </div>
    </div>
</div>
</reply>


