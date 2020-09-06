@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if (session('success2'))
<div class="alert alert-success">
    {{session('success2')}}
</div>
@endif

@if (session('error2'))
<div class="alert alert-danger">
    {{session('error2')}}
</div>
@endif
