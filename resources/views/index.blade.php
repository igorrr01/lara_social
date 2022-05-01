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
                  <img class="img-circle" src="public/assets/img/user1-128x128.jpg" alt="User Image">
                  <span class="username"><a href="#"></a></span>
                  <span class="description">5 часов назад</span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" title="Mark as read">
                    <i class="far fa-circle"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <img class="img-fluid pad" src="public/assets/dist/img/gau.jpg" alt="Photo">

                <p>США новую игрушку подгнало))</p>
<!--                 <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> поделится</button>
 -->                <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> нравится</button>
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

@endsection
@endauth
