<?php
    $cartCount = 0;
    $cart = session()->get('cart', []);
    foreach ($cart as $item) {
        $cartCount += $item['quantity'];
    }
?>

<nav class="bg-white/95 backdrop-blur-md shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-2">
                    <span class="font-display text-2xl font-bold text-primary-600">Amelia</span>
                    <span class="font-display text-xl text-gray-600">Hantaran</span>
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="<?php echo e(route('home')); ?>" class="text-gray-600 hover:text-primary-600 font-medium transition-colors <?php echo e(request()->routeIs('home') ? 'text-primary-600' : ''); ?>">
                    Home
                </a>
                <a href="<?php echo e(route('products.index')); ?>" class="text-gray-600 hover:text-primary-600 font-medium transition-colors <?php echo e(request()->routeIs('products.*') ? 'text-primary-600' : ''); ?>">
                    Katalog
                </a>
                <a href="<?php echo e(route('about')); ?>" class="text-gray-600 hover:text-primary-600 font-medium transition-colors <?php echo e(request()->routeIs('about') ? 'text-primary-600' : ''); ?>">
                    Tentang Kami
                </a>
                <a href="<?php echo e(route('contact')); ?>" class="text-gray-600 hover:text-primary-600 font-medium transition-colors <?php echo e(request()->routeIs('contact') ? 'text-primary-600' : ''); ?>">
                    Kontak
                </a>
            </div>
            
            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                <!-- Cart -->
                <a href="<?php echo e(route('cart.index')); ?>" class="relative p-2 text-gray-600 hover:text-primary-600 transition-colors">
                    <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                    <?php if($cartCount > 0): ?>
                        <span class="absolute -top-1 -right-1 bg-primary-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                            <?php echo e($cartCount); ?>

                        </span>
                    <?php endif; ?>
                </a>
                
                <!-- Auth -->
                <?php if(auth()->guard()->check()): ?>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-primary-600 transition-colors">
                            <i data-lucide="user" class="w-5 h-5"></i>
                            <span class="hidden sm:inline text-sm font-medium"><?php echo e(auth()->user()->name); ?></span>
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </button>
                        
                        <div x-show="open" 
                             @click.away="open = false"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50"
                             style="display: none;">
                            <?php if(auth()->user()->isAdmin()): ?>
                                <a href="<?php echo e(route('admin.dashboard')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">
                                    <i data-lucide="layout-dashboard" class="w-4 h-4 inline mr-2"></i>
                                    Dashboard Admin
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo e(route('orders.index')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">
                                <i data-lucide="package" class="w-4 h-4 inline mr-2"></i>
                                Pesanan Saya
                            </a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>" class="block">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">
                                    <i data-lucide="log-out" class="w-4 h-4 inline mr-2"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="hidden sm:inline-flex items-center px-4 py-2 border border-primary-500 text-primary-500 rounded-lg text-sm font-medium hover:bg-primary-500 hover:text-white transition-all">
                        Login
                    </a>
                <?php endif; ?>
                
                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 text-gray-600" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
        <div class="px-4 py-3 space-y-2">
            <a href="<?php echo e(route('home')); ?>" class="block px-3 py-2 rounded-md text-base font-medium <?php echo e(request()->routeIs('home') ? 'bg-primary-50 text-primary-600' : 'text-gray-600 hover:bg-gray-50'); ?>">
                Home
            </a>
            <a href="<?php echo e(route('products.index')); ?>" class="block px-3 py-2 rounded-md text-base font-medium <?php echo e(request()->routeIs('products.*') ? 'bg-primary-50 text-primary-600' : 'text-gray-600 hover:bg-gray-50'); ?>">
                Katalog
            </a>
            <a href="<?php echo e(route('about')); ?>" class="block px-3 py-2 rounded-md text-base font-medium <?php echo e(request()->routeIs('about') ? 'bg-primary-50 text-primary-600' : 'text-gray-600 hover:bg-gray-50'); ?>">
                Tentang Kami
            </a>
            <a href="<?php echo e(route('contact')); ?>" class="block px-3 py-2 rounded-md text-base font-medium <?php echo e(request()->routeIs('contact') ? 'bg-primary-50 text-primary-600' : 'text-gray-600 hover:bg-gray-50'); ?>">
                Kontak
            </a>
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="block px-3 py-2 rounded-md text-base font-medium text-primary-600 hover:bg-primary-50">
                    Login / Register
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Alpine.js for dropdown -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>