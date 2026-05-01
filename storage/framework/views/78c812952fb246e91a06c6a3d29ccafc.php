<?php $__env->startSection('title', 'Kontak Kami - Amelia Hantaran'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-50 to-cream-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                Hubungi <span class="text-primary-600">Kami</span>
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Kami siap membantu Anda. Jangan ragu untuk menghubungi kami kapan saja.
            </p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div>
                    <span class="text-primary-600 font-semibold text-sm uppercase tracking-wide">Get In Touch</span>
                    <h2 class="font-display text-3xl sm:text-4xl font-bold text-gray-900 mt-2 mb-6">
                        Mari Berbicara
                    </h2>
                    <p class="text-gray-600 mb-8">
                        Punya pertanyaan tentang produk atau layanan kami? Tim kami siap membantu Anda dengan senang hati.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i data-lucide="map-pin" class="w-6 h-6 text-primary-600"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Alamat</h3>
                                <p class="text-gray-600"><?php echo e($settings['company_address'] ?? 'Jl. Mawar No. 123, Jakarta Selatan'); ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i data-lucide="phone" class="w-6 h-6 text-primary-600"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Telepon</h3>
                                <p class="text-gray-600"><?php echo e($settings['company_phone'] ?? '0812-3456-7890'); ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i data-lucide="mail" class="w-6 h-6 text-primary-600"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Email</h3>
                                <p class="text-gray-600"><?php echo e($settings['company_email'] ?? 'hello@ameliahantaran.com'); ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i data-lucide="clock" class="w-6 h-6 text-primary-600"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Jam Operasional</h3>
                                <p class="text-gray-600">Senin - Sabtu: 09.00 - 18.00 WIB</p>
                                <p class="text-gray-500 text-sm">Minggu: Tutup</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Links -->
                    <div class="mt-8">
                        <h3 class="font-semibold text-gray-900 mb-4">Ikuti Kami</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center text-primary-600 hover:bg-primary-500 hover:text-white transition-colors">
                                <i data-lucide="instagram" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center text-primary-600 hover:bg-primary-500 hover:text-white transition-colors">
                                <i data-lucide="facebook" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center text-primary-600 hover:bg-primary-500 hover:text-white transition-colors">
                                <i data-lucide="twitter" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Map -->
                <div>
                    <div class="bg-gray-100 rounded-xl overflow-hidden h-full min-h-[400px]">
                        <?php if(!empty($settings['google_maps'])): ?>
                            <iframe 
                                src="<?php echo e($settings['google_maps']); ?>" 
                                width="100%" 
                                height="100%" 
                                style="border:0; min-height: 400px;" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-cream-50">
                                <div class="text-center p-8">
                                    <i data-lucide="map" class="w-16 h-16 text-primary-300 mx-auto mb-4"></i>
                                    <p class="text-gray-500">Google Maps akan ditampilkan di sini</p>
                                    <p class="text-gray-400 text-sm mt-2"><?php echo e($settings['company_address'] ?? 'Jl. Mawar No. 123, Jakarta Selatan'); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-display text-3xl font-bold text-gray-900 mb-4">
                Butuh Bantuan Cepat?
            </h2>
            <p class="text-gray-600 mb-8">
                Chat kami langsung via WhatsApp untuk respon lebih cepat
            </p>
            <a href="https://wa.me/<?php echo e($settings['whatsapp_number'] ?? '6281234567890'); ?>" target="_blank" 
               class="inline-flex items-center justify-center px-8 py-4 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition-all duration-300 shadow-lg">
                <i data-lucide="message-circle" class="w-5 h-5 mr-2"></i>
                Chat WhatsApp
            </a>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zulfa\OneDrive\Documents\amelia-hantaran\resources\views/contact.blade.php ENDPATH**/ ?>