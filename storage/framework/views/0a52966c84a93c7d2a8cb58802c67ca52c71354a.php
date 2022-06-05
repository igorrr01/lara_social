<?php if(auth()->guard()->check()): ?>


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <section class="content">
       <div class="card-header">
        <div class="row justify-content-center" >
          <div class="col-md-10">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header" >

                <h3 class="card-title"><b>Сделать публикацию</b></h3>
              </div>
              <form method="post" action="<?php echo e(route('post.store')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card-body">
  <!--                 <div class="form-group">
                    <label for="exampleInputEmail1">Заголовок</label>
                    <input type="text" class="form-control" id="title" placeholder="Введите заголовок..." name="title">
                  </div> -->

                  <div class="form-group">
                    <label for="exampleInputFile">Выберите фото</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo">
                        <label class="custom-file-label" for="exampleInputFile">Выбрать</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1" >Комментарий</label>
                    <p class="lead emoji-picker-container">
                    <textarea class="form-control" rows="3" id="description" placeholder="Введите текст..." name="description" data-emojiable="true" data-emoji-input="unicode"></textarea></p>
                  </div>

                    <div class="form-group">
                            <label>Теги: <span class="text-danger"></span><small>(разделитель - #)</small></label>
                            <br>
                            <input type="text" data-role="tagsinput" name="tags" class="form-control tags">
                            <br>
                            <?php if($errors->has('tags')): ?>
                                <span class="text-danger"><?php echo e($errors->first('tags')); ?></span>
                            <?php endif; ?>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
                          </div>
             </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php $__env->stopSection(); ?>

<?php endif; ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\OpenServer2\domains\laravel7.project\resources\views/post/create.blade.php ENDPATH**/ ?>