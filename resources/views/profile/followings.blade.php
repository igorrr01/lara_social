@auth
@extends('layouts.layout')

@section('content')
@include('layouts.alerts')

     <section class="content">
       <div class="card-header">
        <div class="row justify-content-center" >
          <div class="col-md-10">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header" >
                @if(Auth::user()->id == $user->id)
                <h2 class="card-title"><b>Ваши подписки</b></h2></div>
                @else
                <h2 class="card-title"><b>Подписки <a href="/user/{{$user->id}}">{{$user->name}}</a></b></h2></div>
                @endif
                   <div class="card-footer card-comments " style="background: #fefaff">
                      @foreach($followings as $foll)
                      <div class="card-comment" >
                      @if($foll->avatar)
                      <img class="img-circle img-sm" src="/storage/app/{{$foll->avatar}}" alt="User Image">
                      @else
                      <img class="img-circle img-sm" src="/public/assets/dist/img/user.png" alt="User Image">
                      @endif
                       <div class="comment-text">
                      <span class="username">
                      <a href="/user/{{$foll->id}}">{{$foll->name}}</a>
                      </span>
                      @if(Auth::user()->id == $user->id) <a href="/user/unfollow/{{$foll->id}}">Отписаться</a> @endif
                    </div>
                  </div>
                 @endforeach
                </div>
              </div>
            </div>
          </div>
        </section>
@endsection

@endauth
