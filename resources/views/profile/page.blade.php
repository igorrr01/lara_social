@auth
@extends('layouts.layout')

@section('content')
@include('layouts.alerts')

<div class="container col-11">
<div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{ $user->name }}</h3>
                <h5 class="widget-user-desc">Founder &amp; CEO</h5>
                <div class="lockscreen-item">
                <div class="lockscreen-image">
                  @if($user->avatar)
                  <img class="img elevation-2 rounded-circle" src="/storage/app/{{ $user->avatar }}" alt="User Avatar" height="55" width="55">
                  @else
                  <img class="img elevation-2 rounded-circle" src="/public/assets/dist/img/user.png" alt="User Avatar" height="55" width="55">
                  @endif
                  </div>
                  <div class="btn btn-block btn-default"><b>
                    @foreach($followers as $follcheck) 
                    @if($follcheck->followers_count >= 1)
                    @foreach($user->followers as $follcheck)
                    @if(Auth::user()->id == $follcheck->id)
                    <a href="{{ route('user.unfollow', $user->id )}}">Отписаться</a>
                    @endif
                    @endforeach
                    @if(Auth::user()->id != $follcheck->id)
                    <a href="{{ route('user.follow', $user->id )}}">Подписаться</a>
                    @endif
                    @else
                    <a href="{{ route('user.follow', $user->id )}}">Подписаться</a>
                    @endif
                    @endforeach
                    </b>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{ $post_count }}</h5>
                      <span class="description-text">Постов</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">@foreach($followers as $ff) {{$ff->followers_count}} @endforeach
                      </h5>
                      <span class="description-text"><a href="/user/followers/{{ $user->id }}">Подписчиков</a></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">@foreach($followings as $ff) {{$ff->followings_count}} @endforeach</h5>
                      <span class="description-text"><a href="/user/followings/{{ $user->id }}">Подписок</a></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>


<div class="card-group">
<div class="card-columns">

@foreach($posts as $post)
  <div class="card">
    <a href="/post/view/{{ $post->id }}"><img class="card-img-top" src="/storage/app/{{ $post->photo }}" alt="Card image cap"></a>
    <div class="card-body">
      <h5 class="card-title">{{ $post->title }}</h5>
      <p class="card-text">{{ $post->description }}</p>
      <p class="card-text"><small class="text-muted">{{ Carbon\Carbon::parse($post->post_time)->diffForHumans() }}</small></p>
    </div>
  </div>
@endforeach

</div>
</div>
</div>
@endsection

@endauth
