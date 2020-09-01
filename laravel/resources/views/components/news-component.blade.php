@role('admin')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>
    </div>
    <div class="comment-widgets scrollable">
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <div class="d-flex flex-row comment-row">
                    <div class="p-2"><img src="../../assets/images/users/4.jpg" alt="user" width="50" class="rounded-circle"></div>
                    <div class="comment-text active w-100">
                        <h6 class="font-medium">{{$post->user->name}}</h6>
                        <span class="m-b-15 d-block font-bold mb-2">{{ Str::limit($post->title, 30) }} </span>
                        <span class="m-b-15 d-block mb-3">{!! strtolower(substr(strip_tags($post->message), 0, 100)) !!} ...</span>
                        <div class="comment-footer">
                            <span class="text-muted float-right">{{$post->created_at->format('d-m-Y')}}</span>
                            <a href="{{url('/posts/'.$post->id.'/edit')}}"><button type="button" class="btn btn-cyan btn-sm">Bewerken</button></a>
                            <button type="button" class="btn btn-success btn-sm">Publiceren</button>
                            <form action="{{ action('PostsController@destroy', $post->id) }}" method="POST" style="display: inline;" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Verwijderen</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-3 row justify-content-center">
                {{$posts->links()}}
            </div>
        @else
            <p class="text-center">Er zijn nog geen berichten aangemaakt!</p>
        @endif
    </div>
</div>
@endrole
