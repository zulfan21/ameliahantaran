<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin - Amelia Hantaran'); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.min.css" />
    <script src="https://unpkg.com/cropperjs"></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fdf2f8',
                            100: '#fce7f3',
                            200: '#fbcfe8',
                            300: '#f9a8d4',
                            400: '#f472b6',
                            500: '#ec4899',
                            600: '#db2777',
                            700: '#be185d',
                            800: '#9d174d',
                            900: '#831843',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-link {
            @apply flex items-center px-4 py-3 text-gray-600 hover:bg-primary-50 hover:text-primary-600 rounded-lg transition-colors;
        }

        .sidebar-link.active {
            @apply bg-primary-50 text-primary-600 font-medium;
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 flex-shrink-0 hidden lg:flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center space-x-2">
                    <span class="text-xl font-bold text-primary-600">Amelia</span>
                    <span class="text-lg text-gray-600">Admin</span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-primary-50 hover:text-primary-600'); ?>">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                    Dashboard
                </a>

                <a href="<?php echo e(route('admin.orders.index')); ?>"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors <?php echo e(request()->routeIs('admin.orders.*') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-primary-50 hover:text-primary-600'); ?>">
                    <i data-lucide="shopping-bag" class="w-5 h-5 mr-3"></i>
                    Pesanan
                </a>

                <a href="<?php echo e(route('admin.products.index')); ?>"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors <?php echo e(request()->routeIs('admin.products.*') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-primary-50 hover:text-primary-600'); ?>">
                    <i data-lucide="package" class="w-5 h-5 mr-3"></i>
                    Produk
                </a>

                <a href="<?php echo e(route('admin.categories.index')); ?>"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors <?php echo e(request()->routeIs('admin.categories.*') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-primary-50 hover:text-primary-600'); ?>">
                    <i data-lucide="tags" class="w-5 h-5 mr-3"></i>
                    Kategori
                </a>

                <a href="<?php echo e(route('admin.testimonials.index')); ?>"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors <?php echo e(request()->routeIs('admin.testimonials.*') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-primary-50 hover:text-primary-600'); ?>">
                    <i data-lucide="star" class="w-5 h-5 mr-3"></i>
                    Testimoni
                </a>

                <a href="<?php echo e(route('admin.settings.index')); ?>"
                    class="flex items-center px-4 py-3 rounded-lg transition-colors <?php echo e(request()->routeIs('admin.settings.*') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-primary-50 hover:text-primary-600'); ?>">
                    <i data-lucide="settings" class="w-5 h-5 mr-3"></i>
                    Pengaturan
                </a>
            </nav>

            <!-- User -->
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                        <span class="text-primary-600 font-semibold"><?php echo e(substr(auth()->user()->name, 0, 1)); ?></span>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium text-gray-900"><?php echo e(auth()->user()->name); ?></p>
                        <p class="text-sm text-gray-500">Administrator</p>
                    </div>
                </div>
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-3">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                        class="w-full flex items-center justify-center px-4 py-2 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                        <i data-lucide="log-out" class="w-4 h-4 mr-2"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Mobile Header -->
            <header class="lg:hidden bg-white border-b border-gray-200 px-4 py-3">
                <div class="flex items-center justify-between">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center space-x-2">
                        <span class="text-lg font-bold text-primary-600">Amelia</span>
                        <span class="text-gray-600">Admin</span>
                    </a>
                    <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="p-2">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </header>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden bg-white border-b border-gray-200">
                <nav class="p-4 space-y-1">
                    <a href="<?php echo e(route('admin.dashboard')); ?>"
                        class="block px-4 py-2 rounded-lg <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-600' : 'text-gray-600'); ?>">Dashboard</a>
                    <a href="<?php echo e(route('admin.orders.index')); ?>"
                        class="block px-4 py-2 rounded-lg <?php echo e(request()->routeIs('admin.orders.*') ? 'bg-primary-50 text-primary-600' : 'text-gray-600'); ?>">Pesanan</a>
                    <a href="<?php echo e(route('admin.products.index')); ?>"
                        class="block px-4 py-2 rounded-lg <?php echo e(request()->routeIs('admin.products.*') ? 'bg-primary-50 text-primary-600' : 'text-gray-600'); ?>">Produk</a>
                    <a href="<?php echo e(route('admin.categories.index')); ?>"
                        class="block px-4 py-2 rounded-lg <?php echo e(request()->routeIs('admin.categories.*') ? 'bg-primary-50 text-primary-600' : 'text-gray-600'); ?>">Kategori</a>
                    <a href="<?php echo e(route('admin.testimonials.index')); ?>"
                        class="block px-4 py-2 rounded-lg <?php echo e(request()->routeIs('admin.testimonials.*') ? 'bg-primary-50 text-primary-600' : 'text-gray-600'); ?>">Testimoni</a>
                    <a href="<?php echo e(route('admin.galleries.index')); ?>"
                        class="block px-4 py-2 rounded-lg <?php echo e(request()->routeIs('admin.galleries.*') ? 'bg-primary-50 text-primary-600' : 'text-gray-600'); ?>">Galeri</a>
                    <a href="<?php echo e(route('admin.settings.index')); ?>"
                        class="block px-4 py-2 rounded-lg <?php echo e(request()->routeIs('admin.settings.*') ? 'bg-primary-50 text-primary-600' : 'text-gray-600'); ?>">Pengaturan</a>
                </nav>
            </div>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <!-- Flash Messages -->
                <?php if(session('success')): ?>
                    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg flex items-center">
                        <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg flex items-center">
                        <i data-lucide="alert-circle" class="w-5 h-5 mr-2"></i>
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/layouts/admin.blade.php ENDPATH**/ ?>