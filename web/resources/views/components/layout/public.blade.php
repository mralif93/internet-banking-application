@props([
    'title' => 'BankFlow MY — Enterprise Malaysian Digital Retail Banking',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#0f766e">
    <meta name="description" content="BankFlow MY - Enterprise Malaysian Personal Retail Digital Banking with PayNet DuitNow instant transfers and biometric security.">
    <title>{{ $title }}</title>

    <!-- Theme hydration to prevent FOUC -->
    <script>
        (function() {
            try {
                const storedTheme = localStorage.getItem('theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }

                const storedColor = localStorage.getItem('app-color-theme') || 'emerald';
                document.documentElement.setAttribute('data-color-theme', storedColor);
            } catch (_) {}
        })();
    </script>

    <!-- Animate.css for interactive transitions -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 font-sans antialiased transition-colors duration-200 flex flex-col min-h-screen selection:bg-emerald-500 selection:text-white">
    
    <!-- Top Public Navbar -->
    <x-layout.navbar />

    <!-- Mobile Drawer -->
    <x-layout.sidebar />

    <!-- Public Body Viewport -->
    <div class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 flex flex-col">
        <main class="flex-1 min-w-0">
            {{ $slot }}
        </main>
    </div>

    <!-- Public Regulatory Footer (Compact sm) -->
    <footer class="mt-auto border-t border-slate-200/70 dark:border-slate-800/80 bg-white/50 dark:bg-slate-900/50 backdrop-blur-xs text-slate-500 dark:text-slate-400 text-[11px] py-3.5 transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-2.5 text-center sm:text-left">
                <!-- Brand & Status -->
                <div class="flex items-center gap-2 flex-wrap justify-center sm:justify-start">
                    <div class="w-5 h-5 rounded-md bg-emerald-600 flex items-center justify-center text-white font-bold text-[10px] shadow-xs">
                        BF
                    </div>
                    <span class="font-semibold text-slate-700 dark:text-slate-300">
                        BankFlow Malaysia Berhad
                    </span>
                    <span class="hidden sm:inline text-slate-300 dark:text-slate-700">&bull;</span>
                    <span class="text-[10px] text-slate-400 dark:text-slate-500">
                        Member of PIDM (Protected up to RM250k)
                    </span>
                </div>

                <!-- Links & Status -->
                <div class="flex items-center gap-2.5 text-[10px] flex-wrap justify-center">
                    <span class="inline-flex items-center gap-1 text-emerald-600 dark:text-emerald-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        TLS 1.3 / PayNet Direct
                    </span>
                    <span class="text-slate-300 dark:text-slate-700">&bull;</span>
                    <a href="/staff" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                        Staff
                    </a>
                    <span class="text-slate-300 dark:text-slate-700">&bull;</span>
                    <a href="/admin" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                        Admin
                    </a>
                    <span class="text-slate-300 dark:text-slate-700">&bull;</span>
                    <span class="text-slate-400 dark:text-slate-500">&copy; 2026 BankFlow MY</span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
