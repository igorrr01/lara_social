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
                <h2 class="card-title"><b>Рейтинг пользователей</b></h2>
                  <!-- SidebarSearch Form -->
                   <span style = "float: right">
                    <div class="form-inline">
                     <form action="{{route('search')}}" method="post">
                    @csrf
                   <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" name="name" type="search" placeholder="Поиск" aria-label="Search">
                   <div class="input-group-append">
                  <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
           </form>
          </div>
        </span>
              </div>
                  <div class="card-body">
                   @foreach($users as $uuser)
                    <p class="card-text">
                    @if($uuser->avatar)
                    <img src="/storage/app/{{ $uuser->avatar }}"  alt="User Image" class="rounded-circle" height="20" width="20">
                    @else
                    <img class="img elevation-2 rounded-circle" src="/public/assets/dist/img/user.png" alt="User Avatar" height="20" width="20">
                    @endif
                  <a href="/user/{{$uuser->id}}"><b>{{$uuser->name}} </b></a>
                   <span class="badge badge-light" style="float:right"><i class="fas fa-bolt" style="color: blue"></i> {{$uuser->rating}} %</span>
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
