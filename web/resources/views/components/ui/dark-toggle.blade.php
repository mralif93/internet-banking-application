@props([
    'class' => '',
])

<button
    type="button"
    onclick="window.toggleDarkMode()"
    aria-label="Toggle dark mode theme"
    class="relative rounded-full border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 active:scale-95 {{ $class }}"
>
    <!-- Sun Icon (visible in dark mode) -->
    <svg class="w-4.5 h-4.5 sm:w-5 sm:h-5 hidden dark:block text-slate-300 hover:text-amber-400 animate-in spin-in-90 duration-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
    </svg>

    <!-- Moon Icon (visible in light mode) -->
    <svg class="w-4.5 h-4.5 sm:w-5 sm:h-5 block dark:hidden text-slate-600 hover:text-slate-900 animate-in -spin-in-90 duration-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
    </svg>
</button>
