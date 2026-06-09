<?php $__env->startSection('title', 'Home — Gob Sports'); ?>

<?php $__env->startSection('content'); ?>


<div class="hero">
    <div class="hero-inner">
        <div class="hero-text">
            <div class="eyebrow">Malaysia's Sports Gear Store</div>
            <h1>Play at your <span>best</span> level</h1>
            <p>Discover pro-quality equipment for Soccer, Rugby, and Badminton.</p>
            <div class="hero-btns">
                <a href="#shop" class="btn-hero primary">Shop Now</a>
                <a href="<?php echo e(route('home', ['price' => 'sale'])); ?>" class="btn-hero outline">View Sales</a>
            </div>
            <div class="hero-stats">
                <div class="hero-stat"><div class="num">25+</div><div class="lbl">Products</div></div>
                <div class="hero-stat"><div class="num">3</div><div class="lbl">Sports</div></div>
                <div class="hero-stat"><div class="num">RM15</div><div class="lbl">Flat Shipping</div></div>
                <div class="hero-stat"><div class="num">14</div><div class="lbl">Day Returns</div></div>
            </div>
        </div>
        <div class="hero-right">
            <a class="sport-tile featured" href="<?php echo e(route('home', ['sport' => 'soccer'])); ?>">
                <div class="icon">⚽</div><div class="label">Soccer</div>
            </a>
            <a class="sport-tile" href="<?php echo e(route('home', ['sport' => 'rugby'])); ?>">
                <div class="icon">🏉</div><div class="label">Rugby</div>
            </a>
            <a class="sport-tile" href="<?php echo e(route('home', ['sport' => 'badminton'])); ?>">
                <div class="icon">🏸</div><div class="label">Badminton</div>
            </a>
        </div>
    </div>
</div>


<div class="main-content" id="shop">

    
    <div class="sec-title">Browse Categories</div>
    <div class="cat-grid">
        <?php $__currentLoopData = ['all','footwear','apparel','ball','equipment','acc']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="cat-tile <?php echo e(request('category', 'all') === $cat ? 'active' : ''); ?>"
               href="<?php echo e(route('home', array_merge(request()->query(), ['category' => $cat]))); ?>">
                <div class="cat-ico"><?php echo e(['all'=>'🏪','footwear'=>'👟','apparel'=>'👕','ball'=>'⚽','equipment'=>'🏸','acc'=>'🎒'][$cat]); ?></div>
                <div class="cat-name"><?php echo e(ucfirst($cat)); ?></div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="sec-title" style="margin-top:2rem">All Products</div>
    <div class="sport-filter">
        <?php $__currentLoopData = ['all'=>'🏆 All Sports','soccer'=>'⚽ Soccer','rugby'=>'🏉 Rugby','badminton'=>'🏸 Badminton']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="sf-tab <?php echo e(request('sport','all') === $val ? 'active' : ''); ?>"
               href="<?php echo e(route('home', array_merge(request()->query(), ['sport' => $val]))); ?>"><?php echo e($label); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="filter-row">
        <?php $__currentLoopData = ['all'=>'All Prices','low'=>'Under RM100','mid'=>'RM100–RM500','high'=>'RM500+','sale'=>'🔥 Sale']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="f-chip <?php echo e(request('price','all') === $val ? 'active' : ''); ?>"
               href="<?php echo e(route('home', array_merge(request()->query(), ['price' => $val]))); ?>"><?php echo e($label); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <form method="GET" action="<?php echo e(route('home')); ?>" style="margin-left:auto">
            <?php $__currentLoopData = request()->except('sort'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <select name="sort" class="f-sort" onchange="this.form.submit()">
                <option value="default" <?php echo e(request('sort') === 'default' ? 'selected' : ''); ?>>Recommended</option>
                <option value="price-asc" <?php echo e(request('sort') === 'price-asc' ? 'selected' : ''); ?>>Price: Low to High</option>
                <option value="price-desc" <?php echo e(request('sort') === 'price-desc' ? 'selected' : ''); ?>>Price: High to Low</option>
                <option value="rating" <?php echo e(request('sort') === 'rating' ? 'selected' : ''); ?>>Top Rated</option>
            </select>
        </form>
    </div>

    
    <div class="prod-grid">
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a class="prod-card" href="<?php echo e(route('products.show', $product->id)); ?>">
                <div class="pc-img <?php echo e($product->sport === 'rugby' ? 'rugby-bg' : ($product->sport === 'badminton' ? 'badminton-bg' : '')); ?>">
                    <?php if($product->badge): ?>
                        <span class="pc-badge <?php echo e($product->badge); ?>"><?php echo e($product->badge); ?></span>
                    <?php endif; ?>
                    <span class="sport-pill <?php echo e($product->sport); ?>"><?php echo e(ucfirst($product->sport)); ?></span>
                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>"
                         alt="<?php echo e($product->name); ?>" style="max-height:120px;object-fit:contain">
                </div>
                <div class="pc-body">
                    <div class="pc-brand"><?php echo e($product->brand->name); ?></div>
                    <div class="pc-name"><?php echo e($product->name); ?></div>
                    <div class="pc-stars">
                        <span class="pc-stars-val">
                            <?php echo e(str_repeat('★', (int)$product->averageRating())); ?><?php echo e(str_repeat('☆', 5 - (int)$product->averageRating())); ?>

                        </span>
                        <span class="pc-rv-cnt">(<?php echo e($product->reviews->count()); ?>)</span>
                    </div>
                    <div class="pc-foot">
                        <div>
                            <span class="pc-price">RM<?php echo e($product->price); ?></span>
                            <?php if($product->old_price): ?>
                                <span class="pc-old">RM<?php echo e($product->old_price); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <form method="POST" action="<?php echo e(route('cart.add', $product->id)); ?>"
                              onclick="event.stopPropagation()">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="pc-add">+</button>
                        </form>
                    </div>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="grid-column:1/-1;text-align:center;color:#777;padding:3rem">
                No products found. Try a different filter.
            </p>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Welcome\Downloads\GobSports_Laravel\resources\views/home/index.blade.php ENDPATH**/ ?>