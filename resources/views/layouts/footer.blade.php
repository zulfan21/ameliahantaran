@php
    $settings = [
        'company_name' => \App\Models\Setting::get('company_name', 'Amelia Hantaran'),
        'company_address' => \App\Models\Setting::get('company_address', 'Jl. Mawar No. 123, Jakarta Selatan'),
        'company_phone' => \App\Models\Setting::get('company_phone', '0812-3456-7890'),
        'company_email' => \App\Models\Setting::get('company_email', 'hello@ameliahantaran.com'),
        'whatsapp_number' => \App\Models\Setting::get('whatsapp_number', '6281234567890'),
    ];
@endphp

<footer class="bg-gray-900 text-white pt-16 pb-8 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-12 mb-12">

            <div class="lg:col-span-4">
                <div class="flex items-center space-x-2 mb-6">
                    <span class="font-display text-2xl font-bold text-primary-400">Amelia</span>
                    <span class="font-display text-xl text-gray-400">Hantaran</span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-8 pr-4">
                    Elegant hantaran decoration, premium rental boxes, and complete seserahan packages for your
                    unforgettable wedding moment.
                </p>
                <div class="flex space-x-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-primary-500 hover:text-white transition-all duration-300">
                        <i data-lucide="instagram" class="w-5 h-5"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-primary-500 hover:text-white transition-all duration-300">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-primary-500 hover:text-white transition-all duration-300">
                        <i data-lucide="twitter" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-2">
                <h3 class="font-semibold text-lg mb-6 text-white tracking-wide">Quick Links</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('home') }}"
                            class="group flex items-center text-gray-400 hover:text-primary-400 transition-colors text-sm">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}"
                            class="group flex items-center text-gray-400 hover:text-primary-400 transition-colors text-sm">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i> Katalog
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}"
                            class="group flex items-center text-gray-400 hover:text-primary-400 transition-colors text-sm">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i> Tentang Kami
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('testimonials.index') }}"
                            class="group flex items-center text-gray-400 hover:text-primary-400 transition-colors text-sm">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i> Testimoni
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                            class="group flex items-center text-gray-400 hover:text-primary-400 transition-colors text-sm">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 transition-transform group-hover:translate-x-1"></i> Kontak
                        </a>
                    </li>
                </ul>
            </div>

            <div class="lg:col-span-3">
                <h3 class="font-semibold text-lg mb-6 text-white tracking-wide">Hubungi Kami</h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <div class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center flex-shrink-0 mr-3">
                            <i data-lucide="map-pin" class="w-4 h-4 text-primary-400"></i>
                        </div>
                        <span
                            class="text-gray-400 text-sm leading-relaxed mt-1">{{ $settings['company_address'] }}</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center flex-shrink-0 mr-3">
                            <i data-lucide="phone" class="w-4 h-4 text-primary-400"></i>
                        </div>
                        <span class="text-gray-400 text-sm">{{ $settings['company_phone'] }}</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center flex-shrink-0 mr-3">
                            <i data-lucide="mail" class="w-4 h-4 text-primary-400"></i>
                        </div>
                        <span class="text-gray-400 text-sm">{{ $settings['company_email'] }}</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center flex-shrink-0 mr-3">
                            <i data-lucide="clock" class="w-4 h-4 text-primary-400"></i>
                        </div>
                        <span class="text-gray-400 text-sm">Senin - Sabtu: 09.00 - 18.00</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} {{ $settings['company_name'] }}. All rights reserved.
            </p>
            <p class="text-gray-500 text-sm mt-4 md:mt-0 flex items-center">
                Made with <i data-lucide="heart" class="w-4 h-4 mx-1 text-primary-500 fill-current"></i> for your
                special day
            </p>
        </div>
    </div>
</footer>
