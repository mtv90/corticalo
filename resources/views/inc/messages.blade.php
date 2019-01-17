@if(count($errors) > 0)
    @foreach($errors ->all() as $error) 
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach

@endif

@if(session('success'))
    <div class="alert message-success">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert message-alert">
        {{session('error')}}
    </div>
@endif

@if(session('go2choice'))
    <div class="alert alert-warning">
       <strong>{{session('go2choice')}}</strong>
       <a href="/choices/create" class="btn btn-default border-dark border">zur Auswahlerstellung</a>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning">
       <strong>{{session('warning')}}</strong>     
    </div>
@endif