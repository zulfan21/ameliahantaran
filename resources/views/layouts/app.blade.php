<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Amelia Hantaran - Make Your Wedding Hantaran Truly Special')</title>
    <meta name="description" content="@yield('meta_description', 'Elegant hantaran decoration, premium rental boxes, and complete seserahan packages for your unforgettable wedding moment.')">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
                        secondary: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        },
                        cream: {
                            50: '#fdfbf7',
                            100: '#faf6ed',
                            200: '#f5ecd6',
                            300: '#efe0b9',
                            400: '#e6d095',
                            500: '#dbbc6f',
                        }
                    },
                    fontFamily: {
                        'display': ['Playfair Display', 'serif'],
                        'body': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .font-display {
            font-family: 'Playfair Display', serif;
        }
        .gradient-primary {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
        }
        .gradient-cream {
            background: linear-gradient(135deg, #fdfbf7 0%, #faf6ed 100%);
        }
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .btn-primary {
            @apply bg-primary-500 text-white px-6 py-3 rounded-lg font-medium transition-all duration-300 hover:bg-primary-600 hover:shadow-lg;
        }
        .btn-outline {
            @apply border-2 border-primary-500 text-primary-500 px-6 py-3 rounded-lg font-medium transition-all duration-300 hover:bg-primary-500 hover:text-white;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-cream-50 text-gray-800">
    <!-- Navigation -->
    @include('layouts.navigation')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('layouts.footer')
    
    <!-- WhatsApp Float Button -->
    @php
        $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '6281234567890');
    @endphp
    <a href="https://wa.me/{{ $whatsappNumber }}" 
       target="_blank"
       class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 z-50 hover:scale-110">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>
    
    <!-- Scripts -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
    
    @stack('scripts')
</body>
</html>
