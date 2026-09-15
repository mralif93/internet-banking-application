<x-layout.public title="UI Kit & Component System — BankFlow MY">

    <div class="space-y-12 py-6 sm:py-10 animate__animated animate__fadeIn">
        
        <!-- Header Section -->
        <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-emerald-600 via-teal-600 to-slate-900 text-white shadow-xl relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="max-w-2xl relative z-10 space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 text-white text-xs font-semibold backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
                    <span>Design System & Architecture</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                    BankFlow MY UI Kit
                </h1>
                <p class="text-sm sm:text-base text-emerald-100/90 leading-relaxed">
                    A centralized, reusable component library engineered for Malaysian retail banking. Built on Tailwind CSS v4, Blade components, accessible semantic HTML, and full Dark/Light mode support.
                </p>
            </div>
        </div>

        <!-- Component Categories Navigation -->
        <div class="sticky top-20 z-20 p-2 rounded-2xl bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center gap-2 overflow-x-auto text-xs font-semibold">
            <a href="#buttons" class="px-3 py-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors whitespace-nowrap">Buttons</a>
            <a href="#badges" class="px-3 py-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors whitespace-nowrap">Badges & Pills</a>
            <a href="#inputs" class="px-3 py-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors whitespace-nowrap">Form Controls & Inputs</a>
            <a href="#cards" class="px-3 py-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors whitespace-nowrap">Cards & Stat Tiles</a>
            <a href="#alerts" class="px-3 py-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors whitespace-nowrap">Alerts & Notices</a>
            <a href="#banking" class="px-3 py-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors whitespace-nowrap text-emerald-600 dark:text-emerald-400">Banking Domains</a>
            <a href="#icons" class="px-3 py-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors whitespace-nowrap">Lucide Icons</a>
            <a href="#animations" class="px-3 py-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors whitespace-nowrap text-purple-600 dark:text-purple-400 font-bold">Animate.css Lab</a>
        </div>

        <!-- 1. BUTTONS SECTION -->
        <section id="buttons" class="space-y-4 scroll-mt-36">
            <div class="border-b border-slate-200 dark:border-slate-800 pb-3">
                <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                    <span>Buttons</span>
                    <code class="text-xs px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 font-mono text-emerald-600 dark:text-emerald-400 font-normal">&lt;x-ui.button&gt;</code>
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                    Tactile micro-interaction feedback (`active:scale-[0.97]`), accessible focus rings, and various size/variant combinations.
                </p>
            </div>

            <x-ui.card>
                <div class="space-y-6">
                    <div>
                        <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Variants</h4>
                        <div class="flex items-center gap-3 flex-wrap">
                            <x-ui.button variant="primary">Primary Button</x-ui.button>
                            <x-ui.button variant="secondary">Secondary</x-ui.button>
                            <x-ui.button variant="outline">Outline</x-ui.button>
                            <x-ui.button variant="danger">Danger</x-ui.button>
                            <x-ui.button variant="warning">Warning</x-ui.button>
                            <x-ui.button variant="ghost">Ghost</x-ui.button>
                            <x-ui.button variant="link">Inline Link</x-ui.button>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Sizes</h4>
                        <div class="flex items-center gap-3 flex-wrap">
                            <x-ui.button size="xs">Extra Small (xs)</x-ui.button>
                            <x-ui.button size="sm">Small (sm)</x-ui.button>
                            <x-ui.button size="md">Medium (md)</x-ui.button>
                            <x-ui.button size="lg">Large (lg)</x-ui.button>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">With Icons & Disabled States</h4>
                        <div class="flex items-center gap-3 flex-wrap">
                            <x-ui.button variant="primary">
                                <x-slot:icon>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                </x-slot:icon>
                                Add Beneficiary
                            </x-ui.button>
                            <x-ui.button variant="outline">
                                Forward
                                <x-slot:iconRight>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                                </x-slot:iconRight>
                            </x-ui.button>
                            <x-ui.button variant="primary" disabled>
                                Disabled State
                            </x-ui.button>
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </section>

        <!-- 2. BADGES SECTION -->
        <section id="badges" class="space-y-4 scroll-mt-36">
            <div class="border-b border-slate-200 dark:border-slate-800 pb-3">
                <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                    <span>Status Badges & Pills</span>
                    <code class="text-xs px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 font-mono text-emerald-600 dark:text-emerald-400 font-normal">&lt;x-ui.badge&gt;</code>
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                    Subtle indicator tags with optional live pulsating dots for real-time status representation.
                </p>
            </div>

            <x-ui.card>
                <div class="space-y-6">
                    <div>
                        <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Color Variants (with indicator dot)</h4>
                        <div class="flex items-center gap-3 flex-wrap">
                            <x-ui.badge variant="success" dot>Success / Verified</x-ui.badge>
                            <x-ui.badge variant="warning" dot>Pending / Hold</x-ui.badge>
                            <x-ui.badge variant="danger" dot>Halted / Flagged</x-ui.badge>
                            <x-ui.badge variant="info" dot>Information</x-ui.badge>
                            <x-ui.badge variant="purple" dot>Web Portal OOB</x-ui.badge>
                            <x-ui.badge variant="neutral" dot>Neutral Audit</x-ui.badge>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Badge Sizes</h4>
                        <div class="flex items-center gap-3 flex-wrap">
                            <x-ui.badge size="xs">Extra Small (xs)</x-ui.badge>
                            <x-ui.badge size="sm">Small (sm)</x-ui.badge>
                            <x-ui.badge size="md">Medium (md)</x-ui.badge>
                            <x-ui.badge size="lg">Large (lg)</x-ui.badge>
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </section>

        <!-- 3. FORM CONTROLS & INPUTS -->
        <section id="inputs" class="space-y-4 scroll-mt-36">
            <div class="border-b border-slate-200 dark:border-slate-800 pb-3">
                <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                    <span>Form Controls & Inputs</span>
                    <code class="text-xs px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 font-mono text-emerald-600 dark:text-emerald-400 font-normal">&lt;x-ui.input&gt; &bull; &lt;x-ui.select&gt;</code>
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                    High-contrast form fields supporting prefixes, suffixes, labelRight slots, helper text, and validation states.
                </p>
            </div>

            <x-ui.card>
                <div class="space-y-8">
                    <!-- Form Field Sizes (sm, md, lg) -->
                    <div>
                        <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">
                            Form Control Sizes (`size="sm"`, `size="md"`, `size="lg"`)
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-end">
                            <x-ui.input
                                size="sm"
                                label="Small Input (sm)"
                                placeholder="Compact input field"
                                helper="Height: 34px &bull; py-1.5 text-xs"
                                prefix='<x-ui.icon name="search" class="w-3.5 h-3.5 text-slate-400" />'
                            />

                            <x-ui.input
                                size="md"
                                label="Medium Input (md - Default)"
                                placeholder="Standard input field"
                                helper="Height: 42px &bull; py-2.5 text-sm"
                                prefix='<x-ui.icon name="user" class="w-4 h-4 text-slate-400" />'
                            />

                            <x-ui.input
                                size="lg"
                                label="Large Input (lg)"
                                placeholder="Large executive input"
                                helper="Height: 52px &bull; py-3.5 text-base"
                                prefix='<x-ui.icon name="credit-card" class="w-5 h-5 text-slate-400" />'
                            />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-end mt-4">
                            <x-ui.select
                                size="sm"
                                label="Small Select (sm)"
                                :options="['myr' => 'MYR - Ringgit', 'usd' => 'USD - Dollar']"
                                selected="myr"
                            />
                            <x-ui.select
                                size="md"
                                label="Medium Select (md)"
                                :options="['savings' => 'Savings Account-i', 'current' => 'Current Account']"
                                selected="savings"
                            />
                            <x-ui.select
                                size="lg"
                                label="Large Select (lg)"
                                :options="['duitnow' => 'PayNet DuitNow Instant Rail (ISO 20022)']"
                                selected="duitnow"
                            />
                        </div>
                    </div>

                    <div class="border-t border-slate-100 dark:border-slate-800 pt-6">
                        <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">
                            Styles, Slots & Validation States
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Standard Input with Border -->
                            <x-ui.input
                                label="Standard Outlined Input"
                                placeholder="e.g. John Doe"
                                helper="Crisp border with hover transition and focus glow"
                            />

                            <!-- Shadow / Borderless Input -->
                            <x-ui.input
                                label="Borderless Shadow-Elevated Input"
                                placeholder="Modern soft depth"
                                borderless
                                shadow="shadow-md shadow-slate-200/80 dark:shadow-slate-950/70"
                                helper="Used on high-security sign in & register cards"
                            />

                            <!-- Prefix and Suffix Slot Input -->
                            <x-ui.input
                                label="Amount with Currency Prefix"
                                placeholder="0.00"
                                prefix='<span class="font-bold text-slate-400">MYR</span>'
                                suffix='<span class="text-xs text-slate-400">.00</span>'
                                helper="Prefix & Suffix slots handle SVGs or typography"
                            />

                            <!-- Input with labelRight slot -->
                            <x-ui.input
                                label="Password Field"
                                type="password"
                                placeholder="Enter password"
                            >
                                <x-slot:labelRight>
                                    <a href="#inputs" class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline">
                                        Action Link
                                    </a>
                                </x-slot:labelRight>
                            </x-ui.input>

                            <!-- Validation Error State -->
                            <x-ui.input
                                label="Validation Error Example"
                                value="invalid_username@@@"
                                error="Username contains prohibited characters"
                            />

                            <!-- Custom Select Dropdown -->
                            <x-ui.select
                                label="Custom Select Dropdown"
                                :options="[
                                    'instant' => 'DuitNow Instant Rail (ISO 20022)',
                                    'interbank' => 'Interbank GIRO (IBG)',
                                    'rentas' => 'RENTAS High-Value RTGS',
                                ]"
                                selected="instant"
                                helper="Features custom SVG chevrons and uniform styling"
                            />
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </section>

        <!-- 4. CARDS & STAT TILES -->
        <section id="cards" class="space-y-4 scroll-mt-36">
            <div class="border-b border-slate-200 dark:border-slate-800 pb-3">
                <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                    <span>Cards & Telemetry Tiles</span>
                    <code class="text-xs px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 font-mono text-emerald-600 dark:text-emerald-400 font-normal">&lt;x-ui.card&gt; &bull; &lt;x-ui.stat-card&gt;</code>
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                    Structural containers with optional headers, footers, glassmorphism, and hover animations.
                </p>
            </div>

            <!-- Stat Cards Row -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <x-ui.stat-card
                    title="Real-Time DuitNow Throughput"
                    value="42,890 Tx"
                    trend="+14.8%"
                    trendType="up"
                    subtitle="Peak clearing traffic"
                />
                <x-ui.stat-card
                    title="Fraud Halts (24h)"
                    value="2 Holds"
                    trend="-1"
                    trendType="down"
                    subtitle="Intercepted by AML radar"
                />
                <x-ui.stat-card
                    title="System Latency SLA"
                    value="18ms"
                    subtitle="Sub-second settlement"
                />
            </div>

            <!-- Card Variants Example -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.card title="Standard Card" subtitle="Clean border with header & footer slots">
                    <p class="text-xs text-slate-600 dark:text-slate-400">
                        Default container card using balanced padding, high contrast border token, and dark mode compatibility.
                    </p>
                    <x-slot:footer>
                        <div class="flex items-center justify-between text-xs text-slate-500">
                            <span>Standard Footer</span>
                            <x-ui.button size="xs">Action</x-ui.button>
                        </div>
                    </x-slot:footer>
                </x-ui.card>

                <x-ui.card glass hoverable title="Glassmorphic Hoverable Card" subtitle="backdrop-blur-md + hover lift">
                    <p class="text-xs text-slate-600 dark:text-slate-400">
                        Features interactive hover elevation (`hover:-translate-y-0.5 hover:shadow-lg`) and frosted backdrop blur.
                    </p>
                    <x-slot:footer>
                        <div class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold">
                            Glass Footer &rarr;
                        </div>
                    </x-slot:footer>
                </x-ui.card>
            </div>
        </section>

        <!-- 5. ALERTS & NOTICES -->
        <section id="alerts" class="space-y-4 scroll-mt-36">
            <div class="border-b border-slate-200 dark:border-slate-800 pb-3">
                <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                    <span>Alerts & Regulatory Banners</span>
                    <code class="text-xs px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 font-mono text-emerald-600 dark:text-emerald-400 font-normal">&lt;x-ui.alert&gt;</code>
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                    Dismissible alert banners for statutory notifications, cooling-off reminders, and security alarms.
                </p>
            </div>

            <div class="space-y-3">
                <x-ui.alert variant="success" title="Transaction Cleared" dismissible>
                    DuitNow transfer of RM 250.00 to Syarikat Air Selangor successfully settled.
                </x-ui.alert>

                <x-ui.alert variant="info" title="System Maintenance Window">
                    PayNet scheduled batch clearing maintenance tonight between 03:00 AM - 03:30 AM MYT.
                </x-ui.alert>

                <x-ui.alert variant="warning" title="12-Hour Cooling-Off Active">
                    Transfer limit was increased. Mandatory security delay in effect per digital banking security directives.
                </x-ui.alert>

                <x-ui.alert variant="danger" title="Account Circuit Breaker Tripped" dismissible>
                    Emergency Kill Switch activated. Outward fund transfers temporarily restricted.
                </x-ui.alert>
            </div>
        </section>

        <!-- 6. BANKING DOMAIN COMPONENTS -->
        <section id="banking" class="space-y-4 scroll-mt-36">
            <div class="border-b border-slate-200 dark:border-slate-800 pb-3">
                <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100 flex items-center gap-2">
                    <span>Domain Banking Components</span>
                    <code class="text-xs px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 font-mono text-emerald-600 dark:text-emerald-400 font-normal">&lt;x-banking.*&gt;</code>
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                    Bespoke digital retail banking components catering for modern digital security directives and PayNet rails.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Virtual EMV Card -->
                <div class="lg:col-span-6">
                    <x-banking.account-card
                        accountType="Premier Wadiah Savings-i"
                        accountNumber="1640 9821 7842"
                        balance="RM 84,250.00"
                        holderName="AHMAD DANIEL BIN ALIF"
                        gradient="emerald"
                    />
                </div>

                <!-- Security Badges & Controls -->
                <div class="lg:col-span-6 space-y-4">
                    <x-ui.card title="Security Badges & Controls">
                        <div class="space-y-3">
                            <div>
                                <span class="text-xs text-slate-500 block mb-1">Cooling-Off Period Status:</span>
                                <x-banking.security-badge type="cooling_off" />
                            </div>
                            <div>
                                <span class="text-xs text-slate-500 block mb-1">Device Enclave Binding:</span>
                                <x-banking.security-badge type="device_binding" />
                            </div>
                            <div>
                                <span class="text-xs text-slate-500 block mb-1">Emergency Kill Switch Circuit Breaker:</span>
                                <x-banking.security-badge type="kill_switch" />
                            </div>
                        </div>
                    </x-ui.card>
                </div>
            </div>

            <!-- Transaction Items -->
            <x-ui.card title="Recent PayNet Transaction List Item" padding="none">
                <div class="divide-y divide-slate-100 dark:divide-slate-800">
                    <x-banking.transaction-item
                        title="DuitNow Transfer to Ahmad Zaki"
                        reference="TXN-20260909-88124"
                        category="Peer-to-Peer Instant Transfer"
                        date="Today, 11:24 AM"
                        amount="450.00"
                        type="duitnow"
                    />
                    <x-banking.transaction-item
                        title="Payroll Crediting - CentraFlow Tech"
                        reference="SAL-202608-0091"
                        category="Direct Interbank Credit"
                        date="Yesterday, 09:00 AM"
                        amount="8500.00"
                        isCredit="true"
                        type="fpx"
                    />
                    <x-banking.transaction-item
                        title="JomPAY Biller 8888 - Tenaga Nasional"
                        reference="JOM-992140-5"
                        category="Utility Bill Payment"
                        date="07 Sep 2026, 02:15 PM"
                        amount="184.20"
                        type="jompay"
                    />
                </div>
            </x-ui.card>
        </section>

        <!-- 7. MODALS, ALERTS & CONFIRMATION POPUPS -->
        <section id="modals" class="space-y-4 scroll-mt-36">
            <div class="border-b border-slate-200 dark:border-slate-800 pb-3">
                <div class="flex items-center gap-2 mb-1">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100">
                        Modals, Popups & Confirmation Dialogs
                    </h2>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 ring-1 ring-emerald-500/20">
                        Animate.css Powered
                    </span>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Smoothly animated with Animate.css (<code class="text-emerald-600 dark:text-emerald-400">animate__zoomIn</code> on desktop and <code class="text-emerald-600 dark:text-emerald-400">animate__slideInUp</code> on mobile bottom sheets).
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Without Confirmation (Informational Alert / Popup) -->
                <x-ui.card title="Popups Without Confirmation" subtitle="Single-button dismiss dialogs for alerts and notices">
                    <div class="space-y-4">
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                            Designed for straightforward acknowledgements such as successful transactions, session timeouts, or statutory notifications.
                        </p>
                        <div class="flex items-center gap-2.5 flex-wrap">
                            <x-ui.button variant="primary" size="sm" onclick="window.openModal('popup-success')">
                                Success Popup
                            </x-ui.button>
                            <x-ui.button variant="secondary" size="sm" onclick="window.openModal('popup-info')">
                                Info Notice
                            </x-ui.button>
                            <x-ui.button variant="outline" size="sm" onclick="window.openModal('demo-modal')">
                                Standard Content Modal
                            </x-ui.button>
                        </div>
                    </div>
                </x-ui.card>

                <!-- With Confirmation (Action / Danger Popups) -->
                <x-ui.card title="Popups With Confirmation" subtitle="Two-button dialogs requiring explicit user choice (Cancel vs Confirm)">
                    <div class="space-y-4">
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                            Equipped with distinct action styling, cancellation handlers, and danger variants for high-consequence operations (e.g. Kill Switch, Delete Beneficiary, Transfer Approval).
                        </p>
                        <div class="flex items-center gap-2.5 flex-wrap">
                            <x-ui.button variant="danger" size="sm" onclick="window.openModal('confirm-danger')">
                                Danger Confirmation
                            </x-ui.button>
                            <x-ui.button variant="warning" size="sm" onclick="window.openModal('confirm-warning')">
                                Warning Confirmation
                            </x-ui.button>
                            <x-ui.button variant="primary" size="sm" onclick="window.openModal('confirm-transfer')">
                                Transfer Confirmation
                            </x-ui.button>
                        </div>
                    </div>
                </x-ui.card>
        <!-- 8. LUCIDE ICONS SECTION -->
        <section id="icons" class="space-y-4 scroll-mt-36">
            <div class="border-b border-slate-200 dark:border-slate-800 pb-3">
                <div class="flex items-center gap-2 mb-1">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100">
                        Lucide Icons Component Suite
                    </h2>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-teal-100 dark:bg-teal-950 text-teal-700 dark:text-teal-300 ring-1 ring-teal-500/20 font-mono">
                        &lt;x-ui.icon&gt;
                    </span>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Crisp, scalable vector icons powered by the official <strong>Lucide</strong> icon library with custom sizing, stroke widths, and dynamic theme colors.
                </p>
            </div>

            <x-ui.card>
                <div class="space-y-8">
                    <!-- Banking & Security Icons -->
                    <div>
                        <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">
                            Banking & Security Domain Icons
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
                            <div class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50/80 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 text-center gap-2 hover:border-emerald-500/40 transition-colors group">
                                <x-ui.icon name="shield-check" class="w-6 h-6 text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform" />
                                <span class="text-[11px] font-mono text-slate-600 dark:text-slate-400">shield-check</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50/80 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 text-center gap-2 hover:border-emerald-500/40 transition-colors group">
                                <x-ui.icon name="credit-card" class="w-6 h-6 text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform" />
                                <span class="text-[11px] font-mono text-slate-600 dark:text-slate-400">credit-card</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50/80 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 text-center gap-2 hover:border-emerald-500/40 transition-colors group">
                                <x-ui.icon name="lock" class="w-6 h-6 text-amber-600 dark:text-amber-400 group-hover:scale-110 transition-transform" />
                                <span class="text-[11px] font-mono text-slate-600 dark:text-slate-400">lock</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50/80 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 text-center gap-2 hover:border-emerald-500/40 transition-colors group">
                                <x-ui.icon name="smartphone" class="w-6 h-6 text-purple-600 dark:text-purple-400 group-hover:scale-110 transition-transform" />
                                <span class="text-[11px] font-mono text-slate-600 dark:text-slate-400">smartphone</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50/80 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 text-center gap-2 hover:border-emerald-500/40 transition-colors group">
                                <x-ui.icon name="qr-code" class="w-6 h-6 text-teal-600 dark:text-teal-400 group-hover:scale-110 transition-transform" />
                                <span class="text-[11px] font-mono text-slate-600 dark:text-slate-400">qr-code</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50/80 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 text-center gap-2 hover:border-emerald-500/40 transition-colors group">
                                <x-ui.icon name="fingerprint" class="w-6 h-6 text-rose-600 dark:text-rose-400 group-hover:scale-110 transition-transform" />
                                <span class="text-[11px] font-mono text-slate-600 dark:text-slate-400">fingerprint</span>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation & Action Icons -->
                    <div>
                        <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">
                            Action & Navigation Icons
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
                            <div class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50/80 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 text-center gap-2 hover:border-emerald-500/40 transition-colors group">
                                <x-ui.icon name="arrow-right" class="w-6 h-6 text-slate-700 dark:text-slate-300 group-hover:translate-x-1 transition-transform" />
                                <span class="text-[11px] font-mono text-slate-600 dark:text-slate-400">arrow-right</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50/80 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 text-center gap-2 hover:border-emerald-500/40 transition-colors group">
                                <x-ui.icon name="send" class="w-6 h-6 text-slate-700 dark:text-slate-300 group-hover:scale-110 transition-transform" />
                                <span class="text-[11px] font-mono text-slate-600 dark:text-slate-400">send</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50/80 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 text-center gap-2 hover:border-emerald-500/40 transition-colors group">
                                <x-ui.icon name="bell" class="w-6 h-6 text-slate-700 dark:text-slate-300 group-hover:scale-110 transition-transform" />
                                <span class="text-[11px] font-mono text-slate-600 dark:text-slate-400">bell</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50/80 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 text-center gap-2 hover:border-emerald-500/40 transition-colors group">
                                <x-ui.icon name="search" class="w-6 h-6 text-slate-700 dark:text-slate-300 group-hover:scale-110 transition-transform" />
                                <span class="text-[11px] font-mono text-slate-600 dark:text-slate-400">search</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50/80 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 text-center gap-2 hover:border-emerald-500/40 transition-colors group">
                                <x-ui.icon name="download" class="w-6 h-6 text-slate-700 dark:text-slate-300 group-hover:scale-110 transition-transform" />
                                <span class="text-[11px] font-mono text-slate-600 dark:text-slate-400">download</span>
                            </div>
                            <div class="flex flex-col items-center justify-center p-4 rounded-xl bg-slate-50/80 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 text-center gap-2 hover:border-emerald-500/40 transition-colors group">
                                <x-ui.icon name="check-circle-2" class="w-6 h-6 text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform" />
                                <span class="text-[11px] font-mono text-slate-600 dark:text-slate-400">check-circle-2</span>
                            </div>
                        </div>
                    </div>

                    <!-- Usage Guide snippet -->
                    <div class="p-4 rounded-2xl bg-slate-900 text-slate-100 font-mono text-xs space-y-2">
                        <div class="text-slate-400">// Reusable Blade syntax:</div>
                        <div class="text-emerald-400">&lt;x-ui.icon name="shield-check" class="w-5 h-5 text-emerald-500" /&gt;</div>
                        <div class="text-emerald-400">&lt;x-ui.icon name="lock" class="w-4 h-4 text-slate-400" strokeWidth="2.5" /&gt;</div>
                    </div>
                </div>
            </x-ui.card>
        <!-- 9. ANIMATE.CSS ANIMATION LAB -->
        <section id="animations" class="space-y-4 scroll-mt-36">
            <div class="border-b border-slate-200 dark:border-slate-800 pb-3">
                <div class="flex items-center gap-2 mb-1 flex-wrap">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100">
                        Animate.css Animation Lab
                    </h2>
                    <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full bg-purple-100 dark:bg-purple-950 text-purple-700 dark:text-purple-300 ring-1 ring-purple-500/20 font-mono">
                        v4.1.1 Production
                    </span>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    Pre-configured micro-animations utilized across BankFlow MY for route entrances, warning pulses, and high-security dialog transitions. Click any card below to test the animation in real-time.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- 1. Pulse / Alert Trigger -->
                <div 
                    onclick="this.querySelector('.anim-target').classList.remove('animate__pulse'); void this.offsetWidth; this.querySelector('.anim-target').classList.add('animate__pulse');"
                    class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:border-purple-500/50 hover:shadow-md transition-all cursor-pointer select-none group text-center space-y-3"
                >
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mx-auto anim-target animate__animated animate__pulse">
                        <x-ui.icon name="shield-check" class="w-6 h-6" />
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 dark:text-slate-100 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                            Pulse Indicator
                        </h4>
                        <code class="text-[10px] font-mono text-slate-400 block mt-1">animate__pulse</code>
                    </div>
                    <span class="text-[10px] text-purple-600 dark:text-purple-400 font-semibold block">Click to trigger &rarr;</span>
                </div>

                <!-- 2. Shake / Error Validation -->
                <div 
                    onclick="this.querySelector('.anim-target').classList.remove('animate__shakeX'); void this.offsetWidth; this.querySelector('.anim-target').classList.add('animate__shakeX');"
                    class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:border-rose-500/50 hover:shadow-md transition-all cursor-pointer select-none group text-center space-y-3"
                >
                    <div class="w-12 h-12 rounded-2xl bg-rose-100 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center mx-auto anim-target animate__animated animate__shakeX">
                        <x-ui.icon name="lock" class="w-6 h-6" />
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 dark:text-slate-100 group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">
                            Error / Fraud Shake
                        </h4>
                        <code class="text-[10px] font-mono text-slate-400 block mt-1">animate__shakeX</code>
                    </div>
                    <span class="text-[10px] text-rose-600 dark:text-rose-400 font-semibold block">Click to trigger &rarr;</span>
                </div>

                <!-- 3. Bounce / Success -->
                <div 
                    onclick="this.querySelector('.anim-target').classList.remove('animate__bounce'); void this.offsetWidth; this.querySelector('.anim-target').classList.add('animate__bounce');"
                    class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:border-emerald-500/50 hover:shadow-md transition-all cursor-pointer select-none group text-center space-y-3"
                >
                    <div class="w-12 h-12 rounded-2xl bg-teal-100 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center mx-auto anim-target animate__animated animate__bounce">
                        <x-ui.icon name="check-circle-2" class="w-6 h-6" />
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 dark:text-slate-100 group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                            Success Bounce
                        </h4>
                        <code class="text-[10px] font-mono text-slate-400 block mt-1">animate__bounce</code>
                    </div>
                    <span class="text-[10px] text-teal-600 dark:text-teal-400 font-semibold block">Click to trigger &rarr;</span>
                </div>

                <!-- 4. Tada / Settlement Celebration -->
                <div 
                    onclick="this.querySelector('.anim-target').classList.remove('animate__tada'); void this.offsetWidth; this.querySelector('.anim-target').classList.add('animate__tada');"
                    class="p-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:border-amber-500/50 hover:shadow-md transition-all cursor-pointer select-none group text-center space-y-3"
                >
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center mx-auto anim-target animate__animated animate__tada">
                        <x-ui.icon name="credit-card" class="w-6 h-6" />
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900 dark:text-slate-100 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                            Instant Clearing Tada
                        </h4>
                        <code class="text-[10px] font-mono text-slate-400 block mt-1">animate__tada</code>
                    </div>
                    <span class="text-[10px] text-amber-600 dark:text-amber-400 font-semibold block">Click to trigger &rarr;</span>
                </div>
            </div>

            <!-- Modal Entrances Preview Box -->
            <x-ui.card title="Dialog Entrance Animations" subtitle="Applied automatically to <x-ui.modal> and <x-ui.alert-dialog>">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                    <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 flex items-start gap-3">
                        <div class="p-2 rounded-lg bg-purple-100 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 shrink-0">
                            <x-ui.icon name="smartphone" class="w-4 h-4" />
                        </div>
                        <div>
                            <span class="font-bold text-slate-900 dark:text-slate-100 block">Mobile Bottom Sheet:</span>
                            <code class="text-[11px] font-mono text-purple-600 dark:text-purple-400">animate__slideInUp</code>
                            <p class="text-slate-500 dark:text-slate-400 mt-0.5 leading-normal">
                                Glides upward from the bottom edge like a native mobile app sheet.
                            </p>
                        </div>
                    </div>

                    <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 flex items-start gap-3">
                        <div class="p-2 rounded-lg bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 shrink-0">
                            <x-ui.icon name="shield-check" class="w-4 h-4" />
                        </div>
                        <div>
                            <span class="font-bold text-slate-900 dark:text-slate-100 block">Desktop Centered Modal:</span>
                            <code class="text-[11px] font-mono text-emerald-600 dark:text-emerald-400">animate__zoomIn animate__faster</code>
                            <p class="text-slate-500 dark:text-slate-400 mt-0.5 leading-normal">
                                Zooms gently outward from center with backdrop blur.
                            </p>
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </section>

    </div>

    <!-- 1. STANDARD MODAL -->
    <x-ui.modal id="demo-modal" title="Standard Form & Content Modal" size="md">
        <div class="space-y-3 py-2">
            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                This standard modal component automatically adapts: centered card on desktop viewports and transformed into an ergonomic drag-handle bottom sheet on mobile screens.
            </p>
            <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 text-xs text-slate-700 dark:text-slate-300 font-mono">
                &lt;x-ui.modal id="demo-modal" title="..." size="md"&gt;
            </div>
        </div>

        <x-slot:footer>
            <x-ui.button variant="secondary" size="sm" onclick="window.closeModal('demo-modal')">
                Close
            </x-ui.button>
            <x-ui.button variant="primary" size="sm" onclick="window.closeModal('demo-modal')">
                Save Changes
            </x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    <!-- 2. POPUP WITHOUT CONFIRMATION (Success) -->
    <x-ui.alert-dialog
        id="popup-success"
        type="success"
        title="DuitNow Payment Successful"
        confirmText="Done & Return"
    >
        Your fund transfer of <strong class="text-slate-900 dark:text-slate-100">RM 350.00</strong> to Tenaga Nasional Berhad has been cleared instantly via PayNet ISO 20022.
    </x-ui.alert-dialog>

    <!-- 3. POPUP WITHOUT CONFIRMATION (Info) -->
    <x-ui.alert-dialog
        id="popup-info"
        type="info"
        title="Session Security Update"
        confirmText="Understood"
    >
        Your banking session is protected by 256-bit encryption. Device enclave binding verified successfully.
    </x-ui.alert-dialog>

    <!-- 4. POPUP WITH CONFIRMATION (Danger / Kill Switch) -->
    <x-ui.alert-dialog
        id="confirm-danger"
        type="danger"
        title="Activate Emergency Kill Switch?"
        confirm="true"
        confirmText="Yes, Lock Everything"
        cancelText="Keep Active"
        onConfirm="alert('EMERGENCY KILL SWITCH ACTIVATED: All cards, outward DuitNow rails, and portal access frozen immediately.')"
    >
        This will immediately freeze all outward transactions, debit cards, and active sessions across web and mobile. Unlocking requires in-person branch verification with MyKad biometrics.
    </x-ui.alert-dialog>

    <!-- 5. POPUP WITH CONFIRMATION (Warning / Cooling-off) -->
    <x-ui.alert-dialog
        id="confirm-warning"
        type="warning"
        title="Confirm Transfer Limit Bump"
        confirm="true"
        confirmText="Proceed with 12h Hold"
        cancelText="Cancel"
        onConfirm="alert('Limit change accepted. 12-Hour cooling-off delay initiated.')"
    >
        Increasing your daily transfer limit to <strong class="text-slate-900 dark:text-slate-100">RM 50,000.00</strong> triggers a mandatory 12-hour cooling-off window.
    </x-ui.alert-dialog>

    <!-- 6. POPUP WITH CONFIRMATION (Primary / Transfer) -->
    <x-ui.alert-dialog
        id="confirm-transfer"
        type="info"
        title="Confirm Outward Transfer"
        confirm="true"
        confirmText="Authorize via Soft Token"
        cancelText="Back to Edit"
        onConfirm="alert('Transfer authorized and dispatched.')"
    >
        You are about to transfer <strong class="text-emerald-600 dark:text-emerald-400 font-bold">RM 1,200.00</strong> to <strong class="text-slate-900 dark:text-slate-100">AHMAD DANIEL BIN ALIF</strong> (Maybank: 1640 9821 7842).
    </x-ui.alert-dialog>

</x-layout.public>
