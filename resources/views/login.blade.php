<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SnapSwanky</title>
    @include('layouts.alerts')

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/assets/css/fontawesome.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <style>
    body {background: #f7f7f7;background-image: url("public/assets/dist/img/login.jpg");font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;background-attachment: fixed;background-repeat: no-repeat;background-size: cover;position:relative;}
  </style>
</head>

   <div class="row justify-content-center" >
          <div class="col-md-3">

  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="/public/assets/dist/img/logo.jpg" class="brand-image img-circle elevation-3" width="55" 
      style="opacity: .8">
      <a href="/" class="h1"><b>SnapSwanky</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Введите данные для входа</p>

    @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
    @endif
    
      <form action="{{ route('login') }}" method="post">
       @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Пароль" id="password" name="password" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
          <div class="col-15" >
            <button type="submit" class="btn btn-block btn-primary">Войти</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <hr>

      <div class="card-footer">
      <p class="mb-0">
      <i class="fas -solid fa-user-plus"></i>
        <a href="{{ route('user.create') }}" class="text-center"> Регистрация</a>
      </p>
      <i class="fas fa-users "></i>
        <a href="{{ route('password.request') }}">Восстановить пароль</a>
      </p>
    </div>


<!-- /.login-box -->

<div class="card-body">
      <p class="login-box-msg"><i class="fas fa-star" style="color:#7e5aa1"></i> Популярное сегодня</p>

@foreach($posts as $p)
<div class="card card-widget">
  <img class="img-fluid pad rounded" src="/storage/app/{{ $p->photo }}" alt="Dist Photo 1">

    <span class="post-tags mb-1">
        <span class="badge badge-light"><i class="fas fa-user"></i> {{ $p->description }}</span>
      @foreach($p->tags as $tag)
        <span class="badge badge-info"> #
            {{$tag->name}}
          </span>
      @endforeach
     <span class="float-right text-muted"><i class="fas fa-heart" style="color:red"> {{ count($p->likes) }}</i> 
        <i class="fas fa-comments" style="color:blue"> {{ count($p->comments )}}</i></span>
    </span>
</div>
@endforeach

</div>


  </div></div>
    <!-- /.login-card-body -->
  </div>
</div>
</b>
</a></div>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</html>

