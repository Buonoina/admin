  
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left">
                <h2 style="font-size:1rem;"></h2>
            </div>
            <div class="text-right mb-1">
            <a class="btn btn-success" href="<?php echo e(route('product.create')); ?>">新規登録</a>
            </div>
        </div>
    </div>
 
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫</th>
            <th>メーカー名</th>
        </tr>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="text-align:right"><?php echo e($product->id); ?></td>
            <td style="width: 20%;">
            <img src="<?php echo e(Storage::url($product->img_path)); ?>" alt="" class="img-fluid"></td>
            <td style="text-align:right"><?php echo e($product->name); ?></td>
            <td style="text-align:right"><?php echo e($product->price); ?>円</td>
            <td style="text-align:right"><?php echo e($product->stock); ?></td>
            <td><?php echo e($product->company->company_name); ?></td>
            <td style="text-align:center">
            <a class="btn btn-primary" href="<?php echo e(route('product.create',$product->id)); ?>">変更</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
 
    <?php echo $products->links('pagination::bootstrap-5'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin\resources\views/index.blade.php ENDPATH**/ ?>