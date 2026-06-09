<?php $__env->startSection('title', 'Order Confirmed — Gob Sports'); ?>

<?php $__env->startSection('content'); ?>
<div class="success-page">
    <div class="s-confetti">🎉</div>
    <h2>Order Confirmed!</h2>
    <p class="s-sub">Thank you for shopping with Gob Sports. Your order is being processed.</p>

    
    <div class="order-receipt">
        <div class="or-title">Order #<?php echo e($order->id); ?></div>
        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="or-row">
                <span><?php echo e($item->product->name); ?> x<?php echo e($item->quantity); ?></span>
                <span>RM<?php echo e($item->price * $item->quantity); ?></span>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="or-row">
            <span>Shipping</span>
            <span><?php echo e($order->shipping_cost > 0 ? 'RM' . $order->shipping_cost : 'FREE'); ?></span>
        </div>
        <div class="or-row total">
            <span>Total Paid</span>
            <span>RM<?php echo e($order->total_amount + $order->shipping_cost); ?></span>
        </div>
        <div style="margin-top:.75rem;font-size:12px;color:#777">
            Delivering to: <?php echo e($order->shipping_address); ?>

        </div>
    </div>

    
    <?php if($order->status !== 'delivered'): ?>
        <div class="delivery-card">
            <div class="dc-icon">📦</div>
            <h3>Mark as Received</h3>
            <p>Once your order arrives, confirm receipt to unlock the product review feature.</p>
            <form method="POST" action="<?php echo e(route('orders.received', $order->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <button type="submit" class="confirm-recv-btn">I Have Received My Order</button>
            </form>
        </div>
    <?php else: ?>
        
        <div class="sec-title" style="margin-bottom:1rem">Rate Your Purchase</div>
        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="rv-form-card">
                <div class="rv-fc-title"><?php echo e($item->product->name); ?></div>
                <form method="POST" action="<?php echo e(route('reviews.store', $item->product_id)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="star-picker" id="stars-<?php echo e($item->product_id); ?>">
                        <?php for($s = 1; $s <= 5; $s++): ?>
                            <span data-star="<?php echo e($s); ?>" onclick="setStar(<?php echo e($item->product_id); ?>, <?php echo e($s); ?>)">☆</span>
                        <?php endfor; ?>
                    </div>
                    <input type="hidden" name="rating" id="rating-<?php echo e($item->product_id); ?>" value="0">
                    <textarea class="rv-ta" name="comment"
                              placeholder="Share your experience with this product..."></textarea>
                    <button type="submit" class="rv-sub-btn">Submit Review</button>
                </form>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <a href="<?php echo e(route('home')); ?>" class="place-btn" style="display:block;text-align:center;text-decoration:none;margin-top:1rem">
        Continue Shopping
    </a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Welcome\Downloads\GobSports_Laravel\resources\views/orders/success.blade.php ENDPATH**/ ?>