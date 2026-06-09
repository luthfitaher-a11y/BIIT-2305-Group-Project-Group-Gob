
<?php $__env->startSection('title', 'My Reviews — Gob Sports'); ?>
<?php $__env->startSection('content'); ?>
<style>
.reviews-wrap { max-width: 900px; margin: 2rem auto; padding: 0 1.5rem; }
.reviews-back { display: inline-flex; align-items: center; gap: 6px; color: #777; font-size: 13px; font-weight: 600; text-decoration: none; margin-bottom: 1.25rem; }
.reviews-back:hover { color: #111; }
.reviews-title { font-size: 22px; font-weight: 800; margin-bottom: 1.5rem; border-left: 4px solid #e8c84a; padding-left: 10px; }
.review-card { background: #fff; border: 1px solid #e8e8e8; border-radius: 12px; padding: 1.25rem 1.5rem; margin-bottom: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,.05); display: flex; gap: 1rem; align-items: flex-start; }
.rc-img { width: 52px; height: 52px; background: #f5f5f5; border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0; }
.rc-img img { max-width: 100%; max-height: 100%; object-fit: contain; }
.rc-body { flex: 1; }
.rc-product { font-size: 15px; font-weight: 700; margin-bottom: 3px; }
.rc-stars { color: #f5a623; font-size: 16px; margin-bottom: 5px; }
.rc-comment { color: #555; font-size: 14px; line-height: 1.6; }
.rc-date { color: #aaa; font-size: 12px; margin-top: 6px; }
.reviews-empty { text-align: center; padding: 4rem; background: #fff; border-radius: 12px; color: #888; }
</style>

<div class="reviews-wrap">
    <a href="<?php echo e(route('orders.index')); ?>" class="reviews-back">← Back to Orders</a>
    <div class="reviews-title">⭐ My Reviews</div>

    <?php if(session('success')): ?>
        <div style="background:#d4edda; color:#155724; padding:10px 16px; border-radius:8px; margin-bottom:1rem;"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="review-card">
        <div class="rc-img">
            <?php if($review->product->image): ?>
                <img src="<?php echo e(asset('storage/' . $review->product->image)); ?>" alt="<?php echo e($review->product->name); ?>">
            <?php else: ?>
                <span style="font-size:24px;"><?php echo e($review->product->emoji ?? '🏅'); ?></span>
            <?php endif; ?>
        </div>
        <div class="rc-body">
            <div class="rc-product"><?php echo e($review->product->name); ?></div>
            <div class="rc-stars">
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <?php echo e($i <= $review->rating ? '★' : '☆'); ?>

                <?php endfor; ?>
            </div>
            <div class="rc-comment"><?php echo e($review->comment); ?></div>
            <div class="rc-date">Reviewed on <?php echo e($review->created_at->format('d M Y')); ?></div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="reviews-empty">
        <div style="font-size:48px;">⭐</div>
        <p style="margin-top:1rem;">You haven't reviewed anything yet.</p>
        <a href="<?php echo e(route('home')); ?>" style="display:inline-block; margin-top:1rem; background:#111; color:#fff; padding:10px 24px; border-radius:8px; text-decoration:none; font-weight:700;">Start Shopping</a>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Welcome\Downloads\GobSports_Laravel\resources\views/reviews/my.blade.php ENDPATH**/ ?>