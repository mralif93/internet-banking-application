<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#0f172a">
    <meta name="description" content="BankFlow MY Enterprise Admin Authentication Portal. High-security access for Risk, Fraud Operations, and System Administrators.">
    <title>Enterprise Clearance — BankFlow MY Admin Portal</title>

    <!-- Theme hydration -->
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
            } catch (_) {}
        })();
    </script>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-950 text-slate-100 font-sans antialiased flex flex-col min-h-screen selection:bg-rose-600 selection:text-white relative overflow-x-hidden">

    <!-- Ambient Grid & Glow Background -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[700px] h-[500px] bg-gradient-to-b from-rose-900/25 via-red-950/15 to-transparent blur-3xl rounded-full"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#1e293b_1px,transparent_1px)] [background-size:24px_24px] opacity-25"></div>
    </div>

    <!-- Header Strip -->
    <header class="relative z-10 w-full border-b border-slate-800/80 bg-slate-900/60 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between gap-2">
            <div class="flex items-center gap-2.5 min-w-0">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group shrink-0">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-rose-600 to-red-700 flex items-center justify-center text-white font-bold text-xs shadow-md shadow-rose-900/40">
                        <i data-lucide="shield-alert" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <span class="font-bold text-sm text-white tracking-tight flex items-center gap-1.5">
                            BankFlow <span class="hidden xs:inline-block text-[9px] uppercase font-mono font-bold px-1.5 py-0.5 rounded bg-rose-500/20 text-rose-300 border border-rose-500/30">Security Gateway</span>
                        </span>
                    </div>
                </a>
            </div>

            <div class="flex items-center gap-2 sm:gap-2.5 shrink-0">
                <div class="hidden xs:flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-rose-950/70 border border-rose-800/60 text-rose-300 text-[11px] font-mono font-bold">
                    <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                    TIER-1
                </div>
                <a href="{{ route('customer.dashboard') }}" class="text-xs text-slate-400 hover:text-slate-200 transition-colors flex items-center gap-1">
                    <span>Retail</span>
                    <i data-lucide="external-link" class="w-3 h-3"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Form -->
    <main class="relative z-10 flex-1 flex items-center justify-center p-4 sm:p-6 my-auto">
        <div class="w-full max-w-md space-y-5 animate__animated animate__fadeIn">
            
            <!-- Badge & Title -->
            <div class="text-center space-y-2">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-rose-950/80 border border-rose-800/80 text-rose-400 shadow-xl shadow-rose-950/50 ring-4 ring-rose-950/30 mx-auto">
                    <i data-lucide="lock" class="w-7 h-7"></i>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-white">
                        Enterprise Admin Access
                    </h1>
                    <p class="text-xs text-slate-400 mt-0.5">
                        Internal Fraud Management & System Configuration Portal
                    </p>
                </div>
            </div>

            <!-- Login Box -->
            <div class="rounded-3xl border border-slate-800 bg-slate-900/90 backdrop-blur-xl p-6 sm:p-8 shadow-2xl space-y-5 relative overflow-hidden">
                <!-- Top ambient line -->
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-rose-600 via-red-500 to-amber-500"></div>

                @if ($errors->any())
                    <div class="p-3.5 rounded-2xl bg-rose-950/60 border border-rose-800/80 text-xs text-rose-200 flex items-start gap-2.5 animate__animated animate__headShake">
                        <i data-lucide="alert-triangle" class="w-4 h-4 shrink-0 text-rose-400 mt-0.5"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (session('status'))
                    <div class="p-3.5 rounded-2xl bg-emerald-950/60 border border-emerald-800/80 text-xs text-emerald-200 flex items-start gap-2.5">
                        <i data-lucide="check-circle-2" class="w-4 h-4 shrink-0 text-emerald-400 mt-0.5"></i>
                        <p>{{ session('status') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="admin-login" class="block text-xs font-bold text-slate-300 mb-1.5">
                            Staff Username or Enterprise Email
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                <i data-lucide="user-check" class="w-4 h-4"></i>
                            </span>
                            <input
                                type="text"
                                id="admin-login"
                                name="login"
                                value="{{ old('login', 'farhan_azman') }}"
                                required
                                autofocus
                                placeholder="e.g. farhan_azman or admin@bankflow.my"
                                class="w-full pl-9 pr-3.5 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-700 bg-slate-950/70 text-white placeholder-slate-500 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 font-medium transition-all"
                            />
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="admin-password" class="block text-xs font-bold text-slate-300">
                                Master Clearance Password
                            </label>
                            <span class="text-[10px] text-rose-400 font-mono">FIPS 140-2 Encrypted</span>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                <i data-lucide="key-round" class="w-4 h-4"></i>
                            </span>
                            <input
                                type="password"
                                id="admin-password"
                                name="password"
                                value="password123"
                                required
                                placeholder="••••••••••••"
                                class="w-full pl-9 pr-10 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-700 bg-slate-950/70 text-white placeholder-slate-500 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 font-medium transition-all"
                            />
                            <button
                                type="button"
                                onclick="window.togglePasswordVisibility()"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-500 hover:text-slate-300"
                                aria-label="Toggle password visibility"
                            >
                                <i data-lucide="eye" id="pwd-icon" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-xs text-slate-400 pt-1">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                                class="w-4 h-4 rounded border-slate-700 bg-slate-950 text-rose-600 focus:ring-rose-500"
                            />
                            <span class="text-xs">Remember terminal for 8 hours</span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 text-white font-bold text-xs sm:text-sm shadow-lg shadow-rose-900/40 hover:shadow-rose-900/60 active:scale-[0.99] transition-all cursor-pointer flex items-center justify-center gap-2"
                        >
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                            <span>Authenticate Clearance Session</span>
                        </button>
                    </div>

                    <!-- Demo credentials box -->
                    <div class="mt-4 p-3 rounded-2xl bg-slate-950/70 border border-slate-800 text-[11px] space-y-1.5">
                        <div class="flex items-center justify-between font-mono text-slate-400">
                            <span class="font-bold text-slate-300">Default Demo Credentials:</span>
                            <span class="text-rose-400 font-semibold">Ready to Use</span>
                        </div>
                        <div class="grid grid-cols-2 gap-2 pt-1 font-mono text-xs">
                            <div class="p-2 rounded-lg bg-slate-900 border border-slate-800/80">
                                <span class="block text-[10px] text-slate-500">Username</span>
                                <span class="text-slate-200 font-bold select-all">farhan_azman</span>
                            </div>
                            <div class="p-2 rounded-lg bg-slate-900 border border-slate-800/80">
                                <span class="block text-[10px] text-slate-500">Password</span>
                                <span class="text-slate-200 font-bold select-all">password123</span>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="pt-3 border-t border-slate-800 flex items-center justify-between text-[11px] text-slate-500">
                    <span class="flex items-center gap-1.5">
                        <i data-lucide="radio" class="w-3 h-3 text-emerald-500 animate-pulse"></i>
                        Live Audit Trail Active
                    </span>
                    <a href="{{ route('login') }}" class="hover:text-slate-300 transition-colors">
                        Retail User Login &rarr;
                    </a>
                </div>
            </div>

            <!-- Disclaimer -->
            <p class="text-center text-[10px] text-slate-600 max-w-xs mx-auto leading-relaxed">
                Notice: Unauthorized access attempts to this terminal are logged and reported under the Malaysian Computer Crimes Act 1997.
            </p>
        </div>
    </main>

    <footer class="relative z-10 w-full border-t border-slate-800/60 py-3 text-center text-[10px] text-slate-600">
        BankFlow MY Enterprise Core Banking &bull; BNM RMiT Compliant
    </footer>

    <script>
        function togglePasswordVisibility() {
            const input = document.getElementById('admin-password');
            const icon = document.getElementById('pwd-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            if (window.lucide) {
                window.lucide.createIcons();
            }
        }
    </script>
</body>
</html>
