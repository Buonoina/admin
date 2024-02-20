  
<?php $__env->startSection('content'); ?>
    <div class="row" style="text-align:right">
        <div class="col-lg-12">
        <?php if(auth()->guard()->check()): ?>ログイン者：<?php echo e($user_name); ?><?php endif; ?>
        </div>
    </div>
    <div class="row">
            <div class="text-left">
                <h2 style="font-size:1rem;">受注入力</h2>
            </div>
            <div class="text-right mb-1">
                <?php if(auth()->guard()->check()): ?>
                <a class="btn btn-success" href="<?php echo e(route('juchu.create')); ?>">新規登録</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success mt-1"><p><?php echo e($message); ?></p></div>
        <?php endif; ?>
        </div>
    </div>
    
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>客先</th>
            <th>文房具</th>
            <th>個数</th>
            <th>状態</th>
            <th></th>
            <th></th>
            <th>編集者</th>
        </tr>
        <?php $__currentLoopData = $juchus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $juchu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="text-align:right"><?php echo e($juchu->id); ?></td>
            <td><?php echo e($juchu->kyakusaki_name); ?></td>
            <td><?php echo e($juchu->bunbougu_name); ?></td>
            <td style="text-align:right"><?php echo e($juchu->kosu); ?></td>
            <td style="text-align:center"><?php echo e($juchu->joutai); ?></td>
            <td style="text-align:center">
            <?php if(auth()->guard()->check()): ?><a class="btn btn-primary" href="<?php echo e(route('juchu.edit',$juchu->id)); ?>">変更</a>
            </td>
            <td style="text-align:center">
            <?php if(auth()->guard()->check()): ?>
                <form action="<?php echo e(route('juchu.destroy',$juchu->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
                </form>
            <?php endif; ?>
            </td>
            <td><?php echo e($juchu->user_name); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
 
    <?php echo $juchus->links('pagination::bootstrap-5'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin\resources\views/juchu/index.blade.php ENDPATH**/ ?>