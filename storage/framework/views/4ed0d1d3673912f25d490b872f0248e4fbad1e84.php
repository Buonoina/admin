
   
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="font-size:1rem;">文房具登録画面</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="<?php echo e(url('/bunbougus')); ?>">戻る</a>
        </div>
    </div>
</div>
 
<div style="text-align:right;">
<form action="<?php echo e(route('bunbougu.update',$bunbougu->id)); ?>" method="POST">
    <?php echo method_field('PUT'); ?>
    <?php echo csrf_field(); ?>
     
     <div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="name" value="<?php echo e($bunbougu->name); ?>" class="form-control" placeholder="名前">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color:red;">名前を20文字以内で入力してください</span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <input type="text" name="kakaku" value="<?php echo e($bunbougu->kakaku); ?>" class="form-control" placeholder="価格">
                <?php $__errorArgs = ['kakaku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color:red;">価格を数字で入力してください</span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
                <select name="bunrui" class="form-select">
                    <option>分類を選択してください</otion>
                    <?php $__currentLoopData = $bunruis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bunrui): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($bunrui->id); ?>"<?php if($bunrui->id==$bunbougu->bunrui): ?> selected <?php endif; ?>><?php echo e($bunrui->str); ?></otion>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['bunrui'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color:red;">分類を選択してください</span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
            <div class="form-group">
            <textarea class="form-control" style="height:100px" name="shosai" placeholder="詳細"><?php echo e($bunbougu->shosai); ?></textarea>
                <?php $__errorArgs = ['shosai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span style="color:red;">詳細を140文字以内で入力してください</span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        <div class="col-12 mb-2 mt-2">
                <button type="submit" class="btn btn-primary w-100">変更</button>
        </div>
    </div>      
</form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin\resources\views/edit.blade.php ENDPATH**/ ?>