@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{route('posts.create')}}" class="btn btn-outline-success py-1 px-2"  >Create Post</a><br><br>

                    <h3 class="text-center">{{ __('Your Blog Posts') }}</h3>
                    @if(count($posts) > 0)                   

                    <table class="table table-hover table-striped text-center">
                        <thead>
                          <tr>
                            <th>Sl No</th>
                            <th>Title</th>
                            <th colspan="2">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$post->title}}</td>
                                <td><a href="{{route('posts.edit',['post'=>$post->id])}}" class="btn btn-primary">Edit</a></td>
                                <td>
                                    <form id="delete-postt" action="{{ route('posts.destroy',['post'=>$post->id])}}" method="POST">
                                        {{-- <input name="_method" type="hidden" value="DELETE">  --}}
                                        @method('delete')
                                        {{ csrf_field() }}       
                                        <button type="submit" class="btn btn-danger"> Delete</button> 
                                    </form>
                                </td>
                                   
                                {{-- <td>                                    
                                    {!!Form::open(['action'=>['PostController@destroy',$post->id],'method'=>'post'])!!}
                                        {{Form::hidden('_method','DELETE')}}

                                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}

                                    {!!Form::close()!!}
                                </td> --}}                               

                            </tr>
                        @endforeach
                        </tbody>
                      </table>
                    @else
                        <div><h5 class="text-danger text-center">You have no posts</h5></div>
                    @endif
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
