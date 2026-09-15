<x-layout.public title="Sign In — BankFlow MY Retail Internet Banking">

    <div class="min-h-[calc(100vh-16rem)] flex items-center justify-center py-4 sm:py-8 px-2 sm:px-4">
        
        <div class="w-full max-w-sm sm:max-w-md mx-auto space-y-4 animate__animated animate__fadeIn">
            
            <!-- Brand & Security Header (Compact sm) -->
            <div class="text-center space-y-1.5">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white shadow-lg shadow-emerald-500/20 ring-4 ring-emerald-50 dark:ring-emerald-950/50 mx-auto transition-transform hover:scale-105">
                    <x-ui.icon name="shield-check" class="w-6 h-6" strokeWidth="2.2" />
                </div>
                
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
                        Welcome Back
                    </h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        Sign in to BankFlow MY Retail Internet Banking
                    </p>
                </div>

                <div class="flex items-center justify-center gap-1.5 pt-0.5">
                    <x-ui.badge variant="success" size="xs" dot>
                        PayNet DuitNow 24/7
                    </x-ui.badge>
                    <x-ui.badge variant="neutral" size="xs">
                        256-Bit SSL Encryption
                    </x-ui.badge>
                </div>
            </div>

            <!-- Login Form Card (Compact sm styling) -->
            <x-ui.card class="border-slate-200/90 dark:border-slate-800 shadow-xl relative overflow-hidden bg-white/95 dark:bg-slate-900/95 backdrop-blur-md">
                
                <!-- Decorative Top Ambient Stripe -->
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-emerald-500 via-teal-400 to-emerald-600"></div>

                <!-- Error / Status Notice -->
                @if ($errors->any())
                    <div class="p-3 rounded-xl bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-900/60 text-xs text-rose-700 dark:text-rose-300 flex items-start gap-2 mb-3">
                        <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 text-rose-600 dark:text-rose-400 mt-0.5"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (session('status'))
                    <div class="p-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-900/60 text-xs text-emerald-700 dark:text-emerald-300 flex items-start gap-2 mb-3">
                        <i data-lucide="check-circle" class="w-4 h-4 shrink-0 text-emerald-600 dark:text-emerald-400 mt-0.5"></i>
                        <div>
                            <p>{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                <form 
                    method="POST"
                    action="{{ route('customer.login.submit') }}"
                    class="space-y-3.5 pt-1"
                >
                    @csrf
                    <!-- Username Input (size: sm, standard outlined) -->
                    <div>
                        <x-ui.input
                            label="Username"
                            name="username"
                            id="login-username"
                            placeholder="e.g. daniel_alif"
                            :value="old('username', 'daniel_alif')"
                            required
                            size="sm"
                            prefix='<i data-lucide="user" class="w-4 h-4 text-slate-400 inline-block"></i>'
                            helper="Default demo user: daniel_alif (Password: password123)"
                        />
                    </div>

                    <!-- Password Input with Eye Toggle (size: sm, standard outlined) -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="login-password" class="block text-xs font-medium text-slate-700 dark:text-slate-300">
                                Password <span class="text-rose-500 font-semibold">*</span>
                            </label>
                            <a href="/forgot-password" class="text-[11px] font-semibold text-emerald-600 dark:text-emerald-400 hover:text-emerald-500 transition-colors">
                                Forgot Password?
                            </a>
                        </div>
                        <div class="relative rounded-lg shadow-xs">
                            <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="lock" class="w-4 h-4 inline-block"></i>
                            </div>
                            <input
                                type="password"
                                id="login-password"
                                name="password"
                                placeholder="••••••••••••"
                                required
                                class="block w-full bg-white dark:bg-slate-900/90 text-slate-900 dark:text-slate-100 transition-colors duration-150 py-1.5 text-xs sm:text-sm rounded-lg pl-9 pr-9 border border-slate-300 dark:border-slate-700 hover:border-slate-400 dark:hover:border-slate-600 focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-4 focus:ring-emerald-500/15 focus:outline-none placeholder:text-slate-400 dark:placeholder:text-slate-500"
                            />
                            <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center">
                                <button
                                    type="button"
                                    onclick="
                                        const input = document.getElementById('login-password');
                                        input.type = input.type === 'password' ? 'text' : 'password';
                                    "
                                    class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors p-1 rounded hover:bg-slate-100 dark:hover:bg-slate-800"
                                    aria-label="Toggle password visibility"
                                >
                                    <i data-lucide="eye" class="w-3.5 h-3.5 inline-block"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Remember Me & Biometric Alternative -->
                    <div class="flex items-center justify-between text-xs pt-0.5">
                        <label class="flex items-center gap-1.5 cursor-pointer group select-none">
                            <input type="checkbox" class="w-3.5 h-3.5 rounded border-slate-300 dark:border-slate-700 text-emerald-600 focus:ring-emerald-500 bg-white dark:bg-slate-900 shadow-xs cursor-pointer" />
                            <span class="text-[11px] text-slate-600 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-slate-200 transition-colors">Remember username</span>
                        </label>

                        <button
                            type="button"
                            onclick="window.openModal('biometric-dialog')"
                            class="inline-flex items-center gap-1 text-[11px] font-semibold text-emerald-600 dark:text-emerald-400 hover:underline"
                        >
                            <i data-lucide="fingerprint" class="w-3 h-3 inline-block"></i>
                            <span>Mobile Biometric</span>
                        </button>
                    </div>

                    <!-- Submit Action Button (size: sm, with circle icon bg) -->
                    <div class="pt-1">
                        <x-ui.button
                            type="submit"
                            variant="primary"
                            size="sm"
                            fullWidth
                            class="shadow-md shadow-emerald-600/20 hover:shadow-emerald-600/30 pl-2"
                        >
                            <x-slot:icon>
                                <span class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center text-white shrink-0 -ml-1">
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5 inline-block"></i>
                                </span>
                            </x-slot:icon>
                            Sign In to Account
                        </x-ui.button>
                    </div>

                    <!-- Security Notice Pill -->
                    <div class="p-2.5 rounded-lg bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800 flex items-center justify-between text-[10px] text-slate-500 dark:text-slate-400">
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="shield" class="w-3 h-3 text-emerald-600 dark:text-emerald-400 shrink-0 inline-block"></i>
                            <span>Hardware Security Token Active</span>
                        </div>
                        <a href="tel:997" class="font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                            NSRC: 997
                        </a>
                    </div>
                </form>

                <x-slot:footer>
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-1.5 text-xs text-slate-500 dark:text-slate-400 text-center sm:text-left">
                        <span class="text-[11px]">New to BankFlow MY?</span>
                        <a href="/#banking-overview" class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400 hover:underline inline-flex items-center gap-1">
                            <span>Open Account via eKYC</span>
                            <i data-lucide="arrow-right" class="w-3 h-3 inline-block"></i>
                        </a>
                    </div>
                    <div class="mt-2.5 pt-2.5 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-[10px]">
                        <span class="text-slate-400">Bank Operations & Risk Staff:</span>
                        <a href="{{ route('admin.login') }}" class="font-bold text-rose-600 dark:text-rose-400 hover:underline flex items-center gap-1">
                            <i data-lucide="lock" class="w-3 h-3 inline-block"></i>
                            <span>Enterprise Admin Login &rarr;</span>
                        </a>
                    </div>
                </x-slot:footer>
            </x-ui.card>

        </div>

    </div>

    <!-- Login Success Modal (Without Confirmation) -->
    <x-ui.alert-dialog
        id="login-success-dialog"
        type="success"
        size="sm"
        title="Authentication Successful"
        confirmText="Proceed to Dashboard &rarr;"
        onConfirm="window.location.href = '/';"
    >
        Welcome back! Your hardware device enclave token was verified securely. Redirecting to your personal retail banking accounts.
    </x-ui.alert-dialog>

    <!-- Biometric Challenge Popup (With Confirmation) -->
    <x-ui.alert-dialog
        id="biometric-dialog"
        type="info"
        size="sm"
        title="Mobile Soft Token Biometric Push"
        confirm="true"
        confirmText="Simulate Face ID Approval"
        cancelText="Cancel"
        onConfirm="alert('Biometric approval accepted. Signing into retail banking.'); window.location.href = '{{ route('customer.dashboard') }}';"
    >
        A secure authorization challenge has been dispatched to your primary bound smartphone (iPhone 16 Pro). Approve via Touch ID or Face ID to sign in without password.
    </x-ui.alert-dialog>

</x-layout.public>
