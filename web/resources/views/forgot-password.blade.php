<x-layout.public title="Reset Password — BankFlow MY Retail Internet Banking">

    <div class="min-h-[calc(100vh-16rem)] flex items-center justify-center py-4 sm:py-8 px-2 sm:px-4">
        
        <div class="w-full max-w-sm sm:max-w-md mx-auto space-y-4 animate__animated animate__fadeIn">
            
            <!-- Header & Security Icon -->
            <div class="text-center space-y-1.5">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-tr from-amber-500 to-orange-500 text-white shadow-lg shadow-amber-500/20 ring-4 ring-amber-50 dark:ring-amber-950/40 mx-auto transition-transform hover:scale-105">
                    <x-ui.icon name="key-round" class="w-6 h-6" strokeWidth="2.2" />
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
                        Reset Password
                    </h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        Identity verification via MyKad & Bound Soft Token
                    </p>
                </div>

                <div class="flex items-center justify-center gap-1.5 pt-0.5">
                    <x-ui.badge variant="warning" size="xs" dot>
                        12-Hour Cooling Off
                    </x-ui.badge>
                    <x-ui.badge variant="neutral" size="xs">
                        Security Verified
                    </x-ui.badge>
                </div>
            </div>

            <!-- Forgot Password Card -->
            <x-ui.card class="border-slate-200/90 dark:border-slate-800 shadow-xl relative overflow-hidden bg-white/95 dark:bg-slate-900/95 backdrop-blur-md">
                
                <!-- Decorative Top Ambient Stripe -->
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-amber-500 via-orange-400 to-amber-600"></div>

                <form 
                    class="space-y-3.5 pt-1" 
                    onsubmit="event.preventDefault(); window.openModal('reset-challenge-modal');"
                >
                    <!-- MyKad NRIC Input (Standard Outlined) -->
                    <div>
                        <x-ui.input
                            label="MyKad NRIC Number"
                            name="nric"
                            id="reset-nric"
                            placeholder="e.g. 930412-14-5555"
                            required
                            size="sm"
                            prefix='<i data-lucide="id-card" class="w-4 h-4 text-slate-400 inline-block"></i>'
                            helper="Your registered Malaysian National Registration ID"
                        />
                    </div>

                    <!-- Primary Account or Debit Card Number (Standard Outlined) -->
                    <div>
                        <x-ui.input
                            label="Bank Account or Debit Card (16-Digit)"
                            name="account_number"
                            id="reset-account"
                            placeholder="e.g. 1640 9821 7842"
                            required
                            size="sm"
                            prefix='<i data-lucide="credit-card" class="w-4 h-4 text-slate-400 inline-block"></i>'
                            helper="Used to securely verify your relationship with the bank"
                        />
                    </div>

                    <!-- Verification Method Selector (Standard Outlined) -->
                    <div>
                        <x-ui.select
                            label="Authorization Method"
                            name="auth_method"
                            id="reset-auth-method"
                            size="sm"
                            prefix='<i data-lucide="shield-check" class="w-4 h-4 text-slate-400 inline-block"></i>'
                            :options="[
                                'soft_token' => 'Bound Smartphone Soft Token (Instant Push)',
                                'sms_otp' => 'SMS One-Time TAC (RM5,000 max reset tier)',
                                'branch' => 'Branch Biometric Thumbprint Verification',
                            ]"
                            selected="soft_token"
                            required
                        />
                    </div>

                    <!-- Submit Button (with circle icon bg) -->
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
                                    <i data-lucide="shield-alert" class="w-3.5 h-3.5 inline-block"></i>
                                </span>
                            </x-slot:icon>
                            Verify Identity & Proceed
                        </x-ui.button>
                    </div>

                    <!-- Security Alert Note -->
                    <div class="p-2.5 rounded-lg bg-amber-50/80 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800/80 flex items-start gap-2 text-[11px] text-amber-900 dark:text-amber-300">
                        <i data-lucide="info" class="w-3.5 h-3.5 text-amber-600 dark:text-amber-400 shrink-0 mt-0.5 inline-block"></i>
                        <span>For account safety, high-value transfers will be held under a mandatory 12-hour cooling-off delay after password reset.</span>
                    </div>
                </form>

                <x-slot:footer>
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-1.5 text-xs text-slate-500 dark:text-slate-400 text-center sm:text-left">
                        <a href="/login" class="text-[11px] font-semibold text-slate-700 dark:text-slate-300 hover:text-emerald-600 flex items-center gap-1">
                            <i data-lucide="arrow-left" class="w-3.5 h-3.5 inline-block"></i>
                            <span>Back to Sign In</span>
                        </a>
                        <span class="text-[11px]">Need help? <a href="tel:1300882265" class="font-bold text-emerald-600 dark:text-emerald-400 hover:underline">1300-88-BANK</a></span>
                    </div>
                </x-slot:footer>
            </x-ui.card>

        </div>

    </div>

    <!-- Security Challenge Alert Dialog (Confirmation Modal) -->
    <x-ui.alert-dialog
        id="reset-challenge-modal"
        type="warning"
        size="sm"
        title="Security Push Challenge Dispatched"
        confirm="true"
        confirmText="Simulate Authorization &rarr;"
        cancelText="Cancel"
        onConfirm="alert('Authorization confirmed. A temporary one-time password has been sent.'); window.location.href = '/login';"
    >
        A secure reset approval request was pushed to your primary bound phone (iPhone 16 Pro). Approve the prompt to generate temporary reset credentials.
    </x-ui.alert-dialog>

</x-layout.public>
