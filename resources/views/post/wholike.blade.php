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
              <div class="card-header">
                <h2 class="card-title"><b><i class="fas fa-heart" style="color:red"></i> Понравилось</b></h2></div>
                  <div class="card-header" >
                    <div class="card-footer card-comments " style="background: #fefaff">
                    @foreach($wholike as $like)
                     <a href="/post/view/{{ $like->id }}"><img class="img-fluid pad rounded"  src="/storage/app/{{ $like->photo }}" alt="Photo"></a><p></p>
                      <div class="card-header">
                    @foreach($like->likes->reverse() as $likeU)
                      <div class="card-comment" style="border-bottom:0px solid #e9ecef;padding:2px 0">
                    @if($likeU->user->avatar)
                     <img class="img-circle img-sm" src="/storage/app/{{$likeU->user->avatar}}" alt="User Image"> 
                    @else
                      <img class="img-circle img-sm" src="/public/assets/dist/img/user.png" alt="User Image"> 
                    @endif
                      <span class="username"><a href="/user/{{$likeU->user->id}}">{{$likeU->user->name}}</a> 
                      <small> <i class="fas fa-heart mr-2" style="color:red"></i>
                        <span style="float:right"><i class="fas fa-clock"></i> {{$likeU->created_at}}</span></small>
                        </span>
                    </div>
                    @endforeach
                  </div>
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
