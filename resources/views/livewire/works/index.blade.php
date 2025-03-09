<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">My Works</h1>
            
            @auth
                <flux:button :href="route('works.create')" variant="primary">
                    Submit New Work
                </flux:button>
            @else
                <flux:button :href="route('login')" variant="primary">
                    Log in to Submit
                </flux:button>
            @endauth
        </div>
        
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="mb-6">
                    <flux:input
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search by title or excerpt..."
                        type="search"
                    >
                        <x-slot:prefix>
                            <flux:icon.magnifying-glass class="w-5 h-5 text-zinc-400" />
                        </x-slot:prefix>
                    </flux:input>
                </div>
                
                @if ($works->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                            <thead class="bg-zinc-50 dark:bg-zinc-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider cursor-pointer" wire:click="sortBy('title')">
                                        <div class="flex items-center space-x-1">
                                            <span>Title</span>
                                            @if ($sortField === 'title')
                                                <span>
                                                    @if ($sortDirection === 'asc')
                                                        <flux:icon.chevron-up class="w-4 h-4" />
                                                    @else
                                                        <flux:icon.chevron-down class="w-4 h-4" />
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider cursor-pointer" wire:click="sortBy('created_at')">
                                        <div class="flex items-center space-x-1">
                                            <span>Date</span>
                                            @if ($sortField === 'created_at')
                                                <span>
                                                    @if ($sortDirection === 'asc')
                                                        <flux:icon.chevron-up class="w-4 h-4" />
                                                    @else
                                                        <flux:icon.chevron-down class="w-4 h-4" />
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">
                                        Ratings
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
                                @foreach ($works as $work)
                                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-zinc-900 dark:text-white">
                                                {{ $work->title }}
                                            </div>
                                            <div class="text-sm text-zinc-500 dark:text-zinc-400">
                                                {{ Str::limit($work->excerpt, 30) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ $work->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center space-x-4">
                                                <span class="flex items-center text-sm text-green-600 dark:text-green-400">
                                                    <flux:icon.hand-thumb-up variant="solid" class="w-4 h-4 mr-1 text-green-600 dark:text-green-400" />
                                                    {{ $work->up_ratings }}
                                                </span>
                                                <span class="flex items-center text-sm text-red-600 dark:text-red-400">
                                                    <flux:icon.hand-thumb-down variant="solid" class="w-4 h-4 mr-1 text-red-600 dark:text-red-400" />
                                                    {{ $work->down_ratings }}
                                                </span>
                                                @php
                                                    $aggregate = $work->up_ratings - $work->down_ratings;
                                                    $badgeVariant = $aggregate > 0 ? 'success' : ($aggregate < 0 ? 'danger' : 'secondary');
                                                @endphp
                                                <flux:badge variant="{{ $badgeVariant }}" class="flex items-center">
                                                    <flux:icon.heart class="w-4 h-4 mr-1" />
                                                    {{ $aggregate }}
                                                </flux:badge>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <flux:button :href="route('works.show', $work)" variant="ghost" size="xs">
                                                    View
                                                </flux:button>
                                                <flux:button :href="route('works.edit', $work)" variant="filled" size="xs">
                                                    Edit
                                                </flux:button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $works->links() }}
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-zinc-500 dark:text-zinc-400">You haven't created any works yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
