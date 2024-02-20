

  
<?php $__env->startSection('content'); ?>
 
<div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;"></h2>
            </div>
            <div class="text-right mb-1">
            <a class="btn btn-success" href="<?php echo e(route('blog.create')); ?>">新規登録</a>
            </div>
        </div>
    </div>
    <div class="w-75">
        <?php echo $blogs->links('pagination::bootstrap-5'); ?>

        
        <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success">
                <p><?php echo e($message); ?></p>
            </div>
        <?php endif; ?>
    </div>
    
    <table class="table table-bordered w-75">
        <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="width: 7%;" class="fst-italic"><?php echo e($blog->id); ?></td>
            <td style="width: 20%;">
            <img src="<?php echo e(Storage::url($blog->img_path)); ?>" alt="商品画像" class="img-fluid">
            </td>
            <td>
                <h2 class="fs-5 text-primary"><?php echo e($blog->name); ?></h2>                
                <?php echo nl2br($blog->content); ?>

                <div class="text-end">
                <?php if(Auth::id()==$blog->user_id): ?>
                    <!--<a class="btn btn-sm btn-info" href="<?php echo e(route('blog.edit',$blog->id)); ?> }}">
                        変更</a>-->
                    <a class="btn btn-sm btn-success" 
                    href="<?php echo e(route('blog.edit',[$blog->id, 'page' => request()->input('page')])); ?>">
                        変更</a>
                <?php endif; ?>
                <?php if(Auth::id()==$blog->user_id): ?>
                <form action="<?php echo e(route('blog.destroy',[$blog->id, 'page' => request()->input('page')])); ?>" 
                method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-sm btn-danger" 
                    onclick='return confirm("削除しますか？");'>削除</button>
                </form>
                <?php endif; ?>
                </div>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin\resources\views/blog/index.blade.php ENDPATH**/ ?>