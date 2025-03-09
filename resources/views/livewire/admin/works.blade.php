<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Admin: Manage Works</h1>
        </div>
        
        @if (session('message'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                {{ session('message') }}
            </div>
        @endif
        
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <flux:input
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search by title, excerpt, or author..."
                        type="search"
                        class="md:max-w-md"
                    >
                        <x-slot:prefix>
                            <x-heroicon-o-magnifying-glass class="w-5 h-5 text-zinc-400" />
                        </x-slot:prefix>
                    </flux:input>
                    
                    <div class="flex items-center">
                        <flux:checkbox
                            wire:model.live="showDeleted"
                            label="Show deleted works"
                        />
                    </div>
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
                                                        <x-heroicon-o-chevron-up class="w-4 h-4" />
                                                    @else
                                                        <x-heroicon-o-chevron-down class="w-4 h-4" />
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider cursor-pointer" wire:click="sortBy('user_id')">
                                        <div class="flex items-center space-x-1">
                                            <span>Author</span>
                                            @if ($sortField === 'user_id')
                                                <span>
                                                    @if ($sortDirection === 'asc')
                                                        <x-heroicon-o-chevron-up class="w-4 h-4" />
                                                    @else
                                                        <x-heroicon-o-chevron-down class="w-4 h-4" />
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
                                                        <x-heroicon-o-chevron-up class="w-4 h-4" />
                                                    @else
                                                        <x-heroicon-o-chevron-down class="w-4 h-4" />
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
                                @foreach ($works as $work)
                                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700 {{ $work->deleted_at ? 'bg-red-50 dark:bg-red-900/20' : '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-zinc-900 dark:text-white">
                                                {{ $work->title }}
                                            </div>
                                            <div class="text-sm text-zinc-500 dark:text-zinc-400 line-clamp-1">
                                                {{ $work->excerpt }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-zinc-900 dark:text-white">
                                                {{ $work->user->pseudonym }}
                                            </div>
                                            <div class="text-xs text-zinc-500 dark:text-zinc-400">
                                                {{ $work->user->email }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">
                                            <div>Created: {{ $work->created_at->format('M d, Y') }}</div>
                                            @if ($work->deleted_at)
                                                <div class="text-red-500 dark:text-red-400">
                                                    Deleted: {{ $work->deleted_at->format('M d, Y') }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                @if (!$work->deleted_at)
                                                    <flux:button :href="route('works.show', $work)" variant="secondary" size="xs">
                                                        View
                                                    </flux:button>
                                                    
                                                    <flux:button 
                                                        wire:click="deleteWork({{ $work->id }})" 
                                                        wire:confirm="Are you sure you want to delete this work?"
                                                        variant="danger" 
                                                        size="xs"
                                                    >
                                                        Delete
                                                    </flux:button>
                                                @else
                                                    <flux:button 
                                                        wire:click="restoreWork({{ $work->id }})" 
                                                        wire:confirm="Are you sure you want to restore this work?"
                                                        variant="success" 
                                                        size="xs"
                                                    >
                                                        Restore
                                                    </flux:button>
                                                @endif
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
                        <p class="text-zinc-500 dark:text-zinc-400">
                            @if ($showDeleted)
                                No deleted works found.
                            @else
                                No works found matching your search criteria.
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
