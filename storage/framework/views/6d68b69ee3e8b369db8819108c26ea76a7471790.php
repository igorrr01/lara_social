    <section class="content">

        <div class="row justify-content-center" >
          <div class="col-md-10">

	<?php if(session('success')): ?>
		        <div class="alert alert-success">
		        	<?php echo e(session('success')); ?>

		        </div>
    <?php endif; ?>  

    <?php if(session('error')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div></div></section><?php /**PATH E:\OpenServer2\domains\laravel7.project\resources\views/layouts/alerts.blade.php ENDPATH**/ ?>