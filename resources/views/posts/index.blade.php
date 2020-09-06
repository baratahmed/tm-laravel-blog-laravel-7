@extends('layouts.app')

@section('title')
Posts
@endsection


@section('content')
<h1 class="text-center">All Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="/storage/cover_images/{{$post->cover_image}}" class="card-img" alt="...">
              </div>
              <div class="col-md-8 ">
                <div class="card-body">
                  <h5 class="card-title"><a style="text-decoration: none" href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}</a></h5>
                  <p class="card-text">Written on {{$post->created_at->format('d/m/Y')}} by {{$post->user->name}}</p>
                  <p class="card-text">Last updated {{$post->updated_at->format('d/m/Y')}}</p>
                </div>
              </div>
            </div>
          </div>


{{-- <div class="row">
    <div class="col-md-4 col-sm-4">            
        <img src="/storage/cover_images/{{$post->cover_image}}"  width="100%" alt="">            
    </div>

    <div class="col-md-8 col-sm-8">
        <h4><a href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}</a></h4>
        <small>Written on {{$post->created_at->format('d/m/Y')}} by {{$post->user->name}}</small>                        
    </div>
</div> --}}
        @endforeach
        <div>{{$posts->links()}}</div>
    @else
            <div class="text-danger text-center">No Posts Found</div>
    @endif
@endsection