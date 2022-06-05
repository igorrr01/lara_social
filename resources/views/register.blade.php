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
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="/public/assets/dist/img/logo.jpg" class="brand-image img-circle elevation-3" width="55" 
      style="opacity: .8">
      <a href="/" class="h1"><b>SnapSwanky</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Регистрация пользователя</p>

      <form action="{{ route('user.store') }}" method="post">
            @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Логин" id="name" name="name" value="{{ old('name') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('name')
          <div class="btn btn-block btn-danger btn-xs">{{ $message }}</div>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" name="email" value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
           @error('email')
          <div class="btn btn-block btn-danger btn-xs">{{ $message }}</div>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Пароль" id="password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
          <div class="btn btn-block btn-danger btn-xs">{{ $message }}</div>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Повторите пароль" id="password_confirmation" name="password_confirmation">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

          <hr>
          <div class="col-15" >
            <button type="submit" class="btn btn-block btn-primary">Регистрация</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div class="card-footer">
          <i class="fas fa-users mr-2 center"></i>
          <a href="login.html" class="text-center"> Я уже зарегистрирован</a>
      </div>

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
