<?php $__env->startSection('title', $product->name . ' — Gob Sports'); ?>

<?php $__env->startSection('content'); ?>
<div class="detail-page" style="max-width:1100px; margin:2rem auto; padding:0 1.5rem;">

    <a href="<?php echo e(route('home')); ?>" class="back-link" style="display:inline-block; margin-bottom:1.5rem; color:var(--primary); text-decoration:none;">← Back to Products</a>

    <div class="detail-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:2.5rem; background:#fff; border-radius:16px; padding:2rem; box-shadow:0 2px 16px rgba(0,0,0,.08);">

        
        <div style="display:flex; align-items:center; justify-content:center; background:#f8f8f8; border-radius:12px; min-height:300px;">
    <?php if($product->image): ?>
        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" style="max-height:300px; max-width:100%; object-fit:contain;">
    <?php else: ?>
        <span style="font-size:120px;"><?php echo e($product->emoji ?? '🏅'); ?></span>
    <?php endif; ?>
    </div>

        
        <div style="display:flex; flex-direction:column; gap:1rem;">
            <span style="font-size:12px; font-weight:700; text-transform:uppercase; color:#888;"><?php echo e(ucfirst($product->sport)); ?></span>
            <div style="font-size:13px; font-weight:700; color:#aaa; letter-spacing:1px;"><?php echo e($product->brand->name ?? ''); ?></div>
            <h1 style="font-size:1.75rem; font-weight:800; margin:0;"><?php echo e($product->name); ?></h1>

            
            <div style="display:flex; align-items:center; gap:.5rem;">
                <?php $avg = $product->reviews->avg('rating') ?? 0; ?>
                <span style="color:#f5a623;">
                    <?php for($i=1;$i<=5;$i++): ?>
                        <?php echo e($i <= round($avg) ? '★' : '☆'); ?>

                    <?php endfor; ?>
                </span>
                <span style="color:#888; font-size:13px;">(<?php echo e($product->reviews->count()); ?> reviews)</span>
            </div>

            
            <div style="display:flex; align-items:center; gap:1rem;">
                <span style="font-size:2rem; font-weight:800; color:#111;">RM<?php echo e(number_format($product->price, 2)); ?></span>
                <?php if($product->old_price): ?>
                    <span style="font-size:1.1rem; color:#aaa; text-decoration:line-through;">RM<?php echo e(number_format($product->old_price, 2)); ?></span>
                <?php endif; ?>
            </div>

            <p style="color:#555; line-height:1.6;"><?php echo e($product->description); ?></p>

            
            <?php if($product->tags): ?>
            <div style="display:flex; flex-wrap:wrap; gap:.5rem;">
                <?php $__currentLoopData = is_array($product->tags) ? $product->tags : json_decode($product->tags, true) ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span style="background:#f0f0f0; padding:4px 10px; border-radius:20px; font-size:12px;"><?php echo e($tag); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            
            <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST" style="margin-top:1rem;">
                <?php echo csrf_field(); ?>
                <button type="submit" style="background:#111; color:#fff; border:none; padding:14px 32px; border-radius:10px; font-size:16px; font-weight:700; cursor:pointer; width:100%;">
                    Add to Cart
                </button>
            </form>
        </div>
    </div>

    
    <?php if($product->reviews->count() > 0): ?>
    <div style="margin-top:2.5rem; background:#fff; border-radius:16px; padding:2rem; box-shadow:0 2px 16px rgba(0,0,0,.08);">
        <h2 style="margin-bottom:1.5rem;">Customer Reviews</h2>
        <?php $__currentLoopData = $product->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="border-bottom:1px solid #f0f0f0; padding:1rem 0;">
            <div style="display:flex; justify-content:space-between; margin-bottom:.4rem;">
                <strong><?php echo e($review->user->name ?? 'User'); ?></strong>
                <span style="color:#888; font-size:12px;"><?php echo e($review->created_at->format('d M Y')); ?></span>
            </div>
            <div style="color:#f5a623; margin-bottom:.4rem;">
                <?php for($i=1;$i<=5;$i++): ?> <?php echo e($i <= $review->rating ? '★' : '☆'); ?> <?php endfor; ?>
            </div>
            <p style="color:#555; margin:0;"><?php echo e($review->comment); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Welcome\Downloads\GobSports_Laravel\resources\views/products/show.blade.php ENDPATH**/ ?>