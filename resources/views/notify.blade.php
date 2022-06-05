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
              <div class="card-header" style="background: #c9e0f2">
                <h2 class="card-title"><b><i class="far fa-bell"></i> Уведомления</b></h2></div>
                <div class="card-header">
                <h2 class="card-title"><b><i class="fas fa-users mr-2"></i>Подписчики</b></h2>
                <small><span style="float:right"><i class="fas fa-user-clock"> последние 50</i></span></small></div>
                  <div class="card-footer card-comments " style="background: #fefaff">
                  @foreach($foll as $fol)
                  @php $c = 1; @endphp
                  @foreach($fol->followers->reverse() as $fo)
                      <div class="card-comment" >
                      @if($fo->avatar)
                      <img class="img-circle img-sm" src="/storage/app/{{$fo->avatar}}" alt="User Image">
                      @else
                      <img class="img-circle img-sm" src="/public/assets/dist/img/user.png" alt="User Image">
                      @endif
                       <div class="comment-text">
                      <span class="username">
                      <a href="/user/{{$fo->id}}">{{$fo->name}}</a>  
                      <small><i class="fas fa-user-plus"></i> подписался на Вас
                      <span style="float:right"><i class="fas fa-clock"></i> {{$fo->pivot->created_at}}</span></small>
                      </span>
                    </div>
                  </div>
                @php if($c >=50) break; ++$c; @endphp
                @endforeach
              </div>
              @endforeach 


              <div class="card-header">
              <h2 class="card-title"><b><i class="fas fa-heart mr-2" ></i>Likes</b></h2>
              <small><span style="float:right"> последние 5 постов ( <i class="fas fa-heart"></i> 25 ) </span></small></div>
              <div class="card-footer card-comments " style="background: #fefaff">
                  @php $c = 1; @endphp
                  @foreach($like as $likes)
                <div class="card-header">
              <a href="/post/view/{{ $likes->id }}"><img class="img-fluid pad" src="/storage/app/{{ $likes->photo }}" width="50" alt="Photo"></a><br><br>
                  @foreach($likes->likes->reverse() as $ll)
                    @php $c = 1; @endphp
                    <div class="card-comment" style="border-bottom:0px solid #e9ecef;padding:2px 0">
                      @if($ll->user->avatar)
                      <img class="img-circle img-sm" src="/storage/app/{{$ll->user->avatar}}" alt="User Image"> 
                      @else
                      <img class="img-circle img-sm" src="/public/assets/dist/img/user.png" alt="User Image"> 
                      @endif
                        <span class="username"><a href="/user/{{$ll->user->id}}">{{$ll->user->name}}</a> 
                          <small>поставил <i class="fas fa-heart mr-2" style="color:red"></i>
                          <span style="float:right"><i class="fas fa-clock"></i> {{$ll->created_at}}</span></small>
                          </span>
                        </span>
                      </div>
                      @php if($c >=25) break; ++$c; @endphp
                    @endforeach
                  </div>
                  @php if($c >=5) break; ++$c; @endphp
                  @endforeach 
                </div>



           <div class="card-header">
              <h2 class="card-title"><b><i class="fas fa-comments mr-2" ></i>Комментарии</b></h2>
              <small><span style="float:right"> последние 5 постов ( <i class="fas fa-comments"></i> 25 ) </span></small></div>
              <div class="card-footer card-comments " style="background: #fefaff">
                  @php $c = 1; @endphp
                  @foreach($like as $likes)
                <div class="card-header">
              <a href="/post/view/{{ $likes->id }}"><img class="img-fluid pad" src="/storage/app/{{ $likes->photo }}" width="50" alt="Photo"></a><br><br>
                  @foreach($likes->comments->reverse() as $ll)
                    @php $c = 1; @endphp
                    <div class="card-comment" style="border-bottom:0px solid #e9ecef;padding:2px 0">
                      @if($ll->user->avatar)
                      <img class="img-circle img-sm" src="/storage/app/{{$ll->user->avatar}}" alt="User Image"> 
                      @else
                      <img class="img-circle img-sm" src="/public/assets/dist/img/user.png" alt="User Image"> 
                      @endif
                        <span class="username"><a href="/user/{{$ll->user->id}}">{{$ll->user->name}}</a> 
                          <small><i class="fas fa-comment"></i> {{$ll->comment}}
                          <span style="float:right"><i class="fas fa-clock"></i> {{$ll->created_at}}</span></small>
                          </span>
                        </span>
                      </div>
                      @php if($c >=25) break; ++$c; @endphp
                    @endforeach
                  </div>
                  @php if($c >=5) break; ++$c; @endphp
                  @endforeach

                  </div>
                </div>
             </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@endauth

<!-- @foreach($foll as $fol)
@foreach($fol->followers as $fo)
@if($fo->pivot->created_at->toDateTimeString() > Carbon\Carbon::createFromTimestamp(Auth::user()->notify_time))

{{$fo->name}}<br>
@endif
@endforeach
@endforeach -->