<div class="grid auto-rows-min gap-4 md:grid-cols-3">
    <!-- Total Works Card -->
    <div class="flex flex-col justify-between overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-neutral-900 dark:text-white">Total Works</h3>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
        </div>
        <div class="mt-4">
            <p class="text-3xl font-bold text-neutral-900 dark:text-white">{{ $totalWorks }}</p>
            <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Submitted works</p>
        </div>
    </div>
    
    <!-- Placeholder for additional stats -->
    <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
    </div>
    
    <!-- Placeholder for additional stats -->
    <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
    </div>
</div> 