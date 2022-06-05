<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SnapSwanky</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/public/assets/css/style.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/public/assets/css/emoji.css')); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="shortcut icon" type="image/png" href="/public/assets/dist/img/logo.jpg"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-angular.min.js" integrity="sha512-KT0oYlhnDf0XQfjuCS/QIw4sjTHdkefv8rOJY5HHdNEZ6AmOh1DW/ZdSqpipe+2AEXym5D0khNu95Mtmw9VNKg==" crossorigin="anonymous"></script>
  <style>
.content-wrapper {background: #f7f7f7;background-image: url("/public/background.jpg");font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;background-attachment: fixed;background-repeat: no-repeat;background-size: cover;position:relative;}
  </style>
</head>

<?php if(auth()->guard()->guest()): ?>
<?php echo e(view('login')); ?>

<?php endif; ?>
<?php if(auth()->guard()->check()): ?>



<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <a href="<?php echo e(route('post.create')); ?>" class="badge badge-light">Сделать публикацию</a>
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a href="/public/chatify" class="nav-link" >
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"><?php echo e($unread_messages); ?></span>
        </a>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?php echo e($notify_count); ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php echo e($notify_count); ?> Уведомлений</span>
          <?php if($unread_messages >=1): ?>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?php echo e($unread_messages); ?> новых сообщений
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <?php endif; ?>
          <?php if($followers_count >=1): ?>
          <div class="dropdown-divider"></div>
          <a href="<?php echo e(route('notify')); ?>" class="dropdown-item">
            <i class="fas fa-users mr-2" style="color:green"></i> <?php echo e($followers_count); ?> новых подписчиков
          </a>
          <?php endif; ?>
          <?php if($like_count >=1): ?>
          <div class="dropdown-divider"></div>
          <a href="<?php echo e(route('notify')); ?>" class="dropdown-item">
            <i class="fas fa-heart mr-2" style="color:red"></i> <?php echo e($like_count); ?> новых отметок нравится
          </a>
          <?php endif; ?>
          <?php if($comment_count >=1): ?>
          <div class="dropdown-divider"></div>
          <a href="<?php echo e(route('notify')); ?>" class="dropdown-item">
            <i class="fas fa-comments mr-2" style="color:blue"></i> <?php echo e($comment_count); ?> новых комментариев
          </a>
          <?php endif; ?>
          <div class="dropdown-divider"></div>
          <a href="<?php echo e(route('notify')); ?>" class="dropdown-item dropdown-footer">Смотреть все уведомления</a>
        </div>
      </li>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e(url('/news')); ?>" class="brand-link">
      <img src="/public/assets/dist/img/logo.jpg" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SnapSwanky</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php if(Auth::user()->avatar): ?>
          <a href="<?php echo e(route('avatar')); ?>"><img src="/storage/app/<?php echo e(Auth::user()->avatar); ?>" class="rounded" alt="User Image"></a>
          <?php else: ?>
          <a href="<?php echo e(route('avatar')); ?>"><img class="img elevation-2 rounded-circle" src="/public/assets/dist/img/user.png" alt="User Avatar" height="55" width="55"></a>
          <?php endif; ?>
        </div>
        <div class="info">
          <a href="/user/<?php echo e(Auth::user()->id); ?>" class="d-block"><?php echo e(Auth::user()->name); ?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
         <a href="<?php echo e(route('notify')); ?>" class="nav-link">
             <i class="nav-icon fas fa-rss"></i>
              <p>Уведомления <span class="badge badge-primary navbar-badge"><?php if($notify_count >=1): ?><?php echo e($notify_count); ?><?php endif; ?></span></p>
            </a>
          </li>
            <li class="nav-item">
         <a href="/public/chatify" class="nav-link">
             <i class="nav-icon fas fa-comment"></i>
              <p>Сообщения <span class="badge badge-success navbar-badge"><?php if($unread_messages >=1): ?><?php echo e($unread_messages); ?><?php endif; ?></span></p>
            </a>
          </li>         
           <li class="nav-item">
         <a href="<?php echo e(route('user.followings', Auth::user()->id)); ?>" class="nav-link">
             <i class="nav-icon fas fa-user-friends"></i>
              <p>Подписки</p>
            </a>
          </li>
          <li class="nav-item">
         <a href="<?php echo e(route('user.followers', Auth::user()->id)); ?>" class="nav-link">
             <i class="nav-icon fas fa-users"></i>
              <p>Подписчики</p>
            </a>
          </li>
           <li class="nav-item">
         <a href="<?php echo e(route('onlinelist')); ?>" class="nav-link">
             <i class="nav-icon fas fa-user-clock"></i>
              <p>Онлайн<span class="badge badge-danger navbar-badge"><?php if($users_online_count >=1): ?><?php echo e($users_online_count); ?><?php endif; ?></span></p>
            </a>
          </li>  
          <li class="nav-item">
         <a href="<?php echo e(route('userslist')); ?>" class="nav-link">
             <i class="nav-icon fas fa-star"></i>
              <p>Пользователи</p>
            </a>
          </li>         
           <li class="nav-item">
         <a href="<?php echo e(route('settings')); ?>" class="nav-link">
             <i class="nav-icon fas fa-cogs"></i>
              <p>Настройки</p>
            </a>
          </li>         
           <li class="nav-item">
         <a href="<?php echo e(route('logout')); ?>" class="nav-link">
             <i class="nav-icon fas fa-door-open"></i>
              <p>Выход</p>
            </a>
          </li> 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
  <!-- Content Wrapper. Contains page content -->
<?php echo $__env->yieldSection(); ?>
<?php endif; ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH E:\OpenServer2\domains\laravel7.project\resources\views/layouts/layout.blade.php ENDPATH**/ ?>