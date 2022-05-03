@auth
@extends('layouts.layout')

@section('content')

    <!-- Main content -->
    <section class="content">
    <div class="card-header">
        <div class="row justify-content-center" >
          <div class="col-md-10">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  @if($posts->user->avatar)
                  <img class="img-circle" src="/storage/app/{{$posts->user->avatar}}" alt="User Image">
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
                  <span class="description"><h6><span class="badge badge-{{ $randbages }}"><a href="/user/{{$posts->user->id}}" style="color: #ffffff">{{$posts->user->name}}</a></span></h6></span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                  <span class="description" style="color: #343a40"><small>{{ Carbon\Carbon::parse($posts->post_time)->diffForHumans() }}</small></span>
                </div>
                <!-- /.card-tools -->
              </div><div class="card-header">
                <h3 class="card-title">
                 <i class="fas fa-edit"></i>
                 {{ $posts->title }}
                </h3>
          </div>

              <!-- /.card-header -->
              <div class="card-body">
                <img class="img-fluid pad" src="/storage/app/{{ $posts->photo }}" alt="Photo">
                <p>{{ $posts->description }}</p>
                <a href="/post/like/{{ $posts->id }}">

                     @if($posts->likes_count >= 1)
                  @foreach($posts->likes as $like)
                    @if(Auth::user()->id == $like->user_id)
                      <button type="button" class="btn btn-default btn-sm"><i class="fas fa-heart"> {{ count($posts->likes) }}</i></button></a>
                    @endif
                  @endforeach
                    @if(Auth::user()->id != $like->user_id)
                      <button type="button" class="btn btn-default btn-sm"><i class="far fa-heart"> {{ count($posts->likes) }}</i></button></a>
                    @endif
                    @endif
                <span class="float-right text-muted"><i class="fas fa-heart"> {{ count($posts->likes) }}</i> <i class="fas fa-comments"> {{ count($posts->comments_post )}}</i></span>
              </div>

               <div class="card-footer card-comments">
            @if(count($posts->comments_post) >= 1)
            @php $c = 1; @endphp
            @foreach($posts->comments_post as $comment)

            <!-- /.card-body -->
                <div class="card-comment">
                  <!-- User image -->
                  @if($comment->user->avatar)
                  <img class="img-circle img-sm" src="/storage/app/{{$comment->user->avatar}}" alt="User Image">
                  @else
                  <img class="img-circle img-sm" src="/public/assets/dist/img/user.png" alt="User Image">
                  @endif
                  <div class="comment-text">
                    <span class="username">
                      <a href="/user/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
                      <span class="text-muted float-right">{{ Carbon\Carbon::parse($comment->comment_time)->diffForHumans() }}</span>
                    </span><!-- /.username -->
                    {{ $comment->comment }}
                  </div>
                  <!-- /.comment-text -->
                </div>

              @endforeach
              @endif
            </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="/post/comment/{{ $posts->id }}" method="post">
                  @csrf
                  @if(Auth::user()->avatar)
                  <img class="img-fluid img-circle img-sm" src="/storage/app/{{Auth::user()->avatar}}" alt="Alt Text">
                  @else
                  <img class="img-fluid img-circle img-sm" src="/public/assets/dist/img/user.png" alt="Alt Text">
                  @endif
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push">
                    <input type="text" class="form-control form-control-sm" name="comment" placeholder="Нажмите enter для отправки комментария">
                      <span style="float:right;">
                        <div class="mt-2" >
                          <button type="submit" class="btn btn-block btn-primary">Отправить</button> 
                        </span>
                      </div>
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

@endsection
@endauth
