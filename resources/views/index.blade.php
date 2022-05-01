@auth
@extends('layouts.layout')

@section('content')

@foreach($posts as $post)
    <!-- Main content -->
    <section class="content">
    <div class="card-header">

        <div class="row justify-content-center" >
          <div class="col-md-10">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  @if($post->user->avatar)
                  <img class="img-circle" src="/storage/app/{{$post->user->avatar}}" alt="User Image">
                  @else
                  <img class="img-circle" src="/public/assets/dist/img/user.png" alt="User Image">
                  @endif
                  <span class="username"><a href="#"></a></span>
                  <!-- Randbages color -->
                   @php 
                     $inputbages = ['primary','secondary','success','danger','warning','info','light','dark'];
                     $randbages = array_rand($inputbages, 2);
                     $randbages =  $inputbages[$randbages[0]]; 
                   @endphp
                   <!-- /.Randbages color -->
                  <span class="description"><h6><span class="badge badge-{{ $randbages }}"><a href="/user/{{$post->user->id}}" style="color: #ffffff">{{$post->user->name}}</a></span></h6></span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                  <span class="description" style="color: #343a40"><small>{{ Carbon\Carbon::parse($post->post_time)->diffForHumans() }}</small></span>
                </div>
                <!-- /.card-tools -->
              </div><div class="card-header">
                <h3 class="card-title">
                 <i class="fas fa-edit"></i>
                 {{ $post->title }}
                </h3>
          </div>
              <!-- /.card-header -->
              <div class="card-body">
                <img class="img-fluid pad" src="/storage/app/{{ $post->photo }}" alt="Photo">
                <p>{{ $post->description }}</p>
                <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> нравится</button>
                <span class="float-right text-muted">127 лайков - 3 комментариев</span>
              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments">
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="public/assets/dist/img/user3-128x128.jpg" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Машка
                      <span class="text-muted float-right">2 часа назад</span>
                    </span><!-- /.username -->
                    Просто пушка!
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="public/assets/dist/img/user4-128x128.jpg" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Светка878
                      <span class="text-muted float-right">15 минут назад</span>
                    </span><!-- /.username -->
                    Ууух жара. Удачи ребятам)
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="#" method="post">
                  <img class="img-fluid img-circle img-sm" src="public/assets/dist/img/user4-128x128.jpg" alt="Alt Text">
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push">
                    <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
                  </div>
                </form>
              </div>
          </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </section>
@endforeach

@endsection
@endauth
