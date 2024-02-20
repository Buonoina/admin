
   
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">文房具詳細画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="<?php echo e(url('/bunbougus')); ?>?page=<?php echo e($page_id); ?>">戻る</a>
        </div>
    </div>
</div>
 
<div style="text-align:left;">
<div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <?php echo e($bunbougu->name); ?>                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <?php echo e($bunbougu->kakaku); ?>                
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <?php $__currentLoopData = $bunruis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bunrui): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($bunrui->id==$bunbougu->bunrui): ?> <?php echo e($bunrui->str); ?> <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>         
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <?php echo e($bunbougu->shosai); ?>                
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin\resources\views/show.blade.php ENDPATH**/ ?>