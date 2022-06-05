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
                <h2 class="card-title"><b>Пользователи онлайн</b></h2></div>
                  <div class="card-body">
                   @foreach($users_online as $uuser)
                    <p class="card-text">
                    @if($uuser->avatar)
                    <img src="/storage/app/{{ $uuser->avatar }}"  alt="User Image" class="rounded-circle" height="20" width="20">
                    @else
                    <img class="img elevation-2 rounded-circle" src="/public/assets/dist/img/user.png" alt="User Avatar" height="20" width="20">
                    @endif
                  <a href="/user/{{$uuser->id}}"><b>{{$uuser->name}}</b></a>
                @if(Auth::user()->user_status == 5) 
                <span class="badge badge-light" style="float:right;">
                  ({{ Carbon\Carbon::parse($uuser->updated_at)->diffForHumans() }})
                </span>
                @endif
                </p>
               @endforeach
              </div>
             </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@endauth
