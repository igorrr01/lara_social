<?php if(auth()->guard()->check()): ?>


<?php $__env->startSection('content'); ?>

<?php $counter = 0; ?>
<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!-- Main content -->
    <section class="content">
    <div class="card-header">

        <div class="row justify-content-center" >
          <div class="col-md-10">
            <!-- Box Comment -->
            <div class="card card-widget">
              <?php if($counter == 0): ?>
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(route('fnews')); ?>"><i class="nav-icon fas fa-user-friends"></i> Подписки</a></li>
              <li class="breadcrumb-item active"><i class="fas fa-fire"></i><a href="<?php echo e(route('home')); ?>"> Популярное</a></li>
              <li class="breadcrumb-item"><i class="nav-icon fas fa-globe"></i> Новое</li>
             </ol>   
            <?php endif; ?>
              <div class="card-header">
                <div class="user-block">
                  <?php if($post->user->avatar): ?>
                  <img class="img-circle" src="/storage/app/<?php echo e($post->user->avatar); ?>" alt="User Image">
                  <?php else: ?>
                  <img class="img-circle" src="/public/assets/dist/img/user.png" alt="User Image">
                  <?php endif; ?>
                  <span class="username"><a href="#"></a></span>
                  <!-- Randbages color -->
                   <?php 
                     $inputbages = ['primary','secondary','success','danger','warning','info','dark'];
                     $randbages = array_rand($inputbages, 2);
                     $randbages =  $inputbages[$randbages[0]]; 
                   ?>
                   <!-- /.Randbages color -->
                  <span class="description"><h6><span class="badge badge-<?php echo e($randbages); ?>"><a href="/user/<?php echo e($post->user->id); ?>" style="color: #ffffff"><?php echo e($post->user->name); ?></a></span>
                    <?php if($post->user->verify == '1'): ?>
                      <i class="bi bi-patch-check-fill" style="color: blue"></i></h6></span>
                    <?php endif; ?>
                  </h6></span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                  <span class="description" style="color: #343a40"><small>
                    <i class="fas fa-clock"></i> <?php echo e(Carbon\Carbon::parse($post->created_at)->diffForHumans()); ?></small></span>
                </div>
                <!-- /.card-tools -->
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <a href="/post/view/<?php echo e($post->id); ?>"><img class="img-fluid pad rounded"  src="/storage/app/<?php echo e($post->photo); ?>" alt="Photo"></a><p></p>
                  <?php if($post->user->avatar): ?>
                  <img class="direct-chat-img" src="/storage/app/<?php echo e($post->user->avatar); ?>" alt="User Image">
                  <?php else: ?>
                  <img class="direct-chat-img" src="/public/assets/dist/img/user.png" alt="User Image">
                  <?php endif; ?>

                  <div class="direct-chat-text" style="background-color: #ffffff;">
                      
                   <?php echo e($post->description); ?> </div><p></p>
                <a href="/post/like/<?php echo e($post->id); ?>">

                    <?php if($post->likes_count >= 1): ?>

                  <?php $__currentLoopData = $post->likes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $like): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(Auth::user()->id == $like->user_id): ?>
                      <button type="button" class="btn btn-default btn-sm"><i class="fas fa-heart" style="color:red"> <?php echo e(count($post->likes)); ?></i></button></a>
                      <?php break; ?>;
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(Auth::user()->id != $like->user_id): ?>
                      <button type="button" class="btn btn-default btn-sm"><i class="far fa-heart" style="color:red"> <?php echo e(count($post->likes)); ?></i></button></a>
                    <?php endif; ?>
                    <?php else: ?>
                      <button type="button" class="btn btn-default btn-sm"><i class="far fa-heart" style="color:red"> <?php echo e(count($post->likes)); ?></i></button></a>
                    <?php endif; ?>

                  <span class="float-right text-muted"><i class="fas fa-heart" style="color:red"> <?php echo e(count($post->likes)); ?></i> (<a href="/post/wholike/<?php echo e($post->id); ?>">?</a>) 
                  <i class="fas fa-comments" style="color:blue"> <?php echo e(count($post->comments )); ?></i></span>

                        <div class="post-tags mb-4">
                            <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="badge badge-info"> #
                                <a href="/tags/<?php echo e($tag->name); ?>" style="color: #ffffff"><?php echo e($tag->name); ?></a></div>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

            <div class="card-footer card-comments">
            <?php if(count($post->comments) >= 1): ?>
            <?php $c = 1; ?>
            <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <!-- /.card-body -->
              <a href="/user/<?php echo e($comment->user->id); ?>"><b><?php echo e($comment->user->name); ?></b></a>
               <?php if($comment->user->verify == '1'): ?>
                 <i class="bi bi-patch-check-fill" style="color: blue"></i></h6></span>
               <?php endif; ?>
                <div class="card-comment">

                  <!-- User image -->
                  <?php if($comment->user->avatar): ?>
                  <img class="img-circle img-sm" src="/storage/app/<?php echo e($comment->user->avatar); ?>" alt="User Image">
                  <?php else: ?>
                  <img class="img-circle img-sm" src="/public/assets/dist/img/user.png" alt="User Image">
                  <?php endif; ?>

                   <div class="direct-chat-text" style="background-color: #f0f0f0;">
                      <span class="text-muted float-right">
                        <i class="fas fa-clock"></i> 
                        <i><?php echo e(Carbon\Carbon::parse($comment->created_at)->diffForHumans()); ?></i></span>
                    <!-- /.username -->
                    <?php echo e($comment->comment); ?>

                     </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
               <?php if($c >= 5){ ?>    
                  <a href="/post/view/<?php echo e($post->id); ?>"><button type="button" class="btn btn-default btn-block"><i class="fa fa-comments"></i><?php echo e(count($post->comments )); ?> Перейти к обсуждению</button></a>
                </form>
              <?php break;} ++$c; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="/post/comment/<?php echo e($post->id); ?>" method="post">
                  <?php echo csrf_field(); ?>
                  <?php if(Auth::user()->avatar): ?>
                  <img class="img-fluid img-circle img-sm" src="/storage/app/<?php echo e(Auth::user()->avatar); ?>" alt="Alt Text">
                  <?php else: ?>
                  <img class="img-fluid img-circle img-sm" src="/public/assets/dist/img/user.png" alt="Alt Text">
                  <?php endif; ?>
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push">
                    <p class="lead emoji-picker-container">
                    <input type="text" class="form-control form-control-sm" name="comment" placeholder="Введите коментарий..." data-emojiable="true" data-emoji-input="unicode"></p>
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
<?php $counter = 1; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($posts->onEachSide(10)->links('')); ?>


<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\OpenServer2\domains\laravel7.project\resources\views/news.blade.php ENDPATH**/ ?>