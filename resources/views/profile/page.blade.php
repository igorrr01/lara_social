@auth
@extends('layouts.layout')

@section('content')
@include('layouts.alerts')

  @php
    if($user->user_status == '0'){
      header("Location: " . URL::to('/blocked'), true, 302);
      exit();
    }
  @endphp

<div class="container col-11">
<div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              @php
              $rand_back = rand(1,42);
              @endphp
              <div class="widget-user-header text-white" style="background: url('/public/assets/dist/img/themes/{{ $rand_back  }}.jpg') center center;">
              
                <h3 class="widget-user-username"><b>{{ $user->name }}</b> 
                   @if($user->verify == '1')
                      <i class="bi bi-patch-check-fill" style="color: blue"></i>
                      @endif</b><i class="fas fa-heart mr-2" style="color:red"></i> {{$user_like_count}} </h3> 
                @if($user->id != Auth::id())  
                <div class="widget"><a href="/public/chatify?name={{$user->name}}" class="badge badge-light">Написать</a></div>
                @endif

                @if($user->firstname) 
                <i class="fas fa-user-circle"></i> {{ $user->firstname }} {{ $user->lastname }} <br>                @endif
                <div class="lockscreen-item">
                <div class="lockscreen-image" style="left: -45px;">
                  @if($user->avatar)
                  <img class="img elevation-2 rounded-circle" src="/storage/app/{{ $user->avatar }}" alt="User Avatar" height="55" width="55">
                  @else
                  <img class="img elevation-2 rounded-circle" src="/public/assets/dist/img/user.png" alt="User Avatar" height="55" width="55">
                  @endif
                  </div>
                  @if($user->id != Auth::id())             
                  <div class="btn btn-block btn-default"><b>
                    @foreach($followers as $follcheck) 
                    @if($follcheck->followers_count >= 1)
                    @foreach($user->followers as $follcheck)
                    @if(Auth::user()->id == $follcheck->id)
                <h3 class="widget-user-username" >
                      @php $rat = $user_all_count*100/$top_like_count;  @endphp
                      <b><i class="fas fa-bolt" style="color: blue"></i> {{ round($rat, 1) }} %
                      <span style="float:right">
                        <a href="{{ route('user.unfollow', $user->id )}}"><i class="fas fa-user-minus" style="color: indigo"></i></a>
                      </span></h3></b>
                       <div class="progress">
                  <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{$rat}}%">
                  </div>
                </div>    
                @endif
                    @endforeach
                    @if(Auth::user()->id != $follcheck->id && $check != 1)
                    <h3 class="widget-user-username" >
                      @php $rat = $user_all_count*100/$top_like_count;  @endphp
                      <b><i class="fas fa-bolt" style="color: blue"></i> {{ round($rat, 1) }} %
                      <span style="float:right">
                        <a href="{{ route('user.follow', $user->id )}}"><i class="fas fa-user-plus" style="color: indigo"></i></a>
                      </span></h3></b>
                       <div class="progress">
                  <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{$rat}}%">
                  </div>
                </div>
                    @endif
                    @else
                  <h3 class="widget-user-username" >
                      @php $rat = $user_all_count*100/$top_like_count;  @endphp
                      <b><i class="fas fa-bolt" style="color: blue"></i> {{ round($rat, 1) }} % 
                      <span style="float:right">
                        <a href="{{ route('user.follow', $user->id )}}"><i class="fas fa-user-plus" style="color: indigo"></i></a>
                      </span></h3></b>
                       <div class="progress">
                  <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{$rat}}%">
                  </div>
                </div>                    @endif
                    @endforeach
                    </b>
                  </div>
                  @else
                  <div class="btn btn-block btn-default">
                    <h3 class="widget-user-username" >
                      @php $rat = $user_all_count*100/$top_like_count;  @endphp
                      <b><i class="fas fa-bolt" style="color: blue"></i> {{ round($rat, 1) }} %</h3></b>
                       <div class="progress">
                  <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{$rat}}%">
                  </div>
                </div>
                   </div>
                  @endif
                </div>
              </div>                        
              @if($user->id != Auth::id()) <hr>     @endif  
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><i class="fab fa-usps"></i> {{ $post_count }} постов</h5>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><i class="nav-icon fas fa-users"></i> @foreach($followers as $ff) {{$ff->followers_count}} 
                         @endforeach
                         <a href="/user/followers/{{ $user->id }}">подписчиков</a>
                      </h5>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header"><i class="nav-icon fas fa-user-friends"></i>@foreach($followings as $ff) {{$ff->followings_count}} @endforeach
                      <a href="/user/followings/{{ $user->id }}">подписок</a>
                      </h5>
                    </div>
                    <!-- /.description-block -->
                  </div>

                  <!-- /.col -->
                </div>
                                  @if($user->about) 
                  <span style="float: left"><a class="badge badge-light">
                    <i class="fas fa-info-circle"></i> {{ $user->about }} 
                  </a></span>
                  @endif
                <!-- /.row -->
            </div>

    @if(Auth::user()->user_status == 5) 
<!--         <a href="/user/block/{{$user->id}}" ><i class="fas fa-trash-alt">удалить</i></a> 
 -->        
  <a href="/user/block/{{$user->id}}" ><i class="fas fa-ban">блокировать</i></a> 
    @endif
<div class="card-group">
<div class="card-columns">

@foreach($posts as $post)
  <div class="card">
    <a href="/post/view/{{ $post->id }}"><img class="card-img-top rounded" src="/storage/app/{{ $post->photo }}" alt="Card image cap"></a>
    <div class="card-body">

      <span class="post-tags mb-1">
        <i class="fas fa-user"></i>{{mb_strimwidth("$post->description", 0, 200, "...")}}
 
     <span class="float-right text-muted"><i class="fas fa-heart" style="color:red"> {{ count($post->likes) }}</i> 
        <i class="fas fa-comments" style="color:blue"> {{ count($post->comments )}}</i></span>
    </span>

      <p class="card-text"><small class="text-muted">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</small></p>

    </div>
  </div>
@endforeach

</div>
</div>
</div>
@endsection

@endauth
