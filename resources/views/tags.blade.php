@auth
@extends('layouts.layout')

@section('content')

@php $counter = 0; @endphp
@foreach($posts as $post)
    <!-- Main content -->
    <section class="content">
    <div class="card-header">

        <div class="row justify-content-center" >
          <div class="col-md-10">
            <!-- Box Comment -->
            <div class="card card-widget">
              @if($counter == 0)
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fas fa-hashtag"></i><b> {{$tag}}</b></li>
             </ol>   
            @endif
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
                  <span class="description" style="color: #343a40"><small>
                    <i class="fas fa-clock"></i> {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</small></span>
                </div>
                <!-- /.card-tools -->
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <a href="/post/view/{{ $post->id }}"><img class="img-fluid pad rounded"  src="/storage/app/{{ $post->photo }}" alt="Photo"></a><p></p>
                  @if($post->user->avatar)
                  <img class="direct-chat-img" src="/storage/app/{{$post->user->avatar}}" alt="User Image">
                  @else
                  <img class="direct-chat-img" src="/public/assets/dist/img/user.png" alt="User Image">
                  @endif

                  <div class="direct-chat-text" style="background-color: #ffffff;">
                      
                   {{ $post->description }} </div><p></p>
                <a href="/post/like/{{ $post->id }}">

                    @if($post->likes_count >= 1)

                  @foreach($post->likes as $like)
                    @if(Auth::user()->id == $like->user_id)
                      <button type="button" class="btn btn-default btn-sm"><i class="fas fa-heart"> {{ count($post->likes) }}</i></button></a>
                      @break;
                    @endif
                  @endforeach
                    @if(Auth::user()->id != $like->user_id)
                      <button type="button" class="btn btn-default btn-sm"><i class="far fa-heart"> {{ count($post->likes) }}</i></button></a>
                    @endif
                    @else
                      <button type="button" class="btn btn-default btn-sm"><i class="far fa-heart"> {{ count($post->likes) }}</i></button></a>
                    @endif
                        <span class="post-tags mb-4">
                            @foreach($post->tags as $tag)
                              <span class="badge badge-info"> #
                                <a href="/tags/{{ $tag->name }}" style="color: #ffffff">{{$tag->name}}</a></span>
                             @endforeach
                        </span>

                <span class="float-right text-muted"><i class="fas fa-heart"> {{ count($post->likes) }} (<a href="/post/wholike/{{ $post->id }}">?</a>)</i> 
                  <i class="fas fa-comments"> {{ count($post->comments )}}</i></span>
              </div>


            <div class="card-footer card-comments">
            @if(count($post->comments) >= 1)
            @php $c = 1; @endphp
            @foreach($post->comments as $comment)

            <!-- /.card-body -->
              <a href="/user/{{ $comment->user->id }}"><b>{{ $comment->user->name }}</b></a>
                <div class="card-comment">

                  <!-- User image -->
                  @if($comment->user->avatar)
                  <img class="img-circle img-sm" src="/storage/app/{{$comment->user->avatar}}" alt="User Image">
                  @else
                  <img class="img-circle img-sm" src="/public/assets/dist/img/user.png" alt="User Image">
                  @endif

                   <div class="direct-chat-text" style="background-color: #f0f0f0;">
                      <span class="text-muted float-right">
                        <i class="fas fa-clock"></i> 
                        <i>{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</i></span>
                    <!-- /.username -->
                    {{ $comment->comment }}
                     </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
               <?php if($c >= 5){ ?>    
                  <a href="/post/view/{{ $post->id }}"><button type="button" class="btn btn-default btn-block"><i class="fa fa-comments"></i>{{ count($post->comments )}} ?????????????? ?? ????????????????????</button></a>
                </form>
              <?php break;} ++$c; ?>
              @endforeach
              @endif
            </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="/post/comment/{{ $post->id }}" method="post">
                  @csrf
                  @if(Auth::user()->avatar)
                  <img class="img-fluid img-circle img-sm" src="/storage/app/{{Auth::user()->avatar}}" alt="Alt Text">
                  @else
                  <img class="img-fluid img-circle img-sm" src="/public/assets/dist/img/user.png" alt="Alt Text">
                  @endif
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push">
                    <p class="lead emoji-picker-container">
                    <input type="text" class="form-control form-control-sm" name="comment" placeholder="?????????????? enter ?????? ???????????????? ??????????????????????" data-emojiable="true" data-emoji-input="unicode"></p>
                      <span style="float:right;">
                        <div class="mt-2" >
                          <button type="submit" class="btn btn-block btn-primary">??????????????????</button> 
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
@php $counter = 1; @endphp
@endforeach
                    {{ $posts->onEachSide(10)->links('') }}

@endsection
@endauth
