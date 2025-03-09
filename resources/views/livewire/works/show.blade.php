<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $work->title }}</h1>
                    
                    <div class="flex items-center space-x-2">
                        @if (Auth::check() && Auth::id() === $work->user_id)
                            <flux:button :href="route('works.edit', $work)" variant="ghost" size="sm">
                                Edit Work
                            </flux:button>
                        @endif
                        
                        <flux:button :href="route('works.random')" variant="ghost" size="sm">
                            Read Random
                        </flux:button>
                    </div>
                </div>
                
                <div class="flex items-center mb-6">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                            {{ substr($work->user->pseudonym, 0, 1) }}
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-zinc-900 dark:text-white">
                            {{ $work->user->pseudonym }}
                        </p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">
                            {{ $work->created_at->format('F j, Y') }}
                        </p>
                    </div>
                </div>
                
                @if ($work->cover_image)
                    <div class="mb-6">
                        <img src="{{ Storage::url($work->cover_image) }}" alt="{{ $work->title }}" class="w-full h-64 object-cover rounded-lg">
                    </div>
                @endif
                
                <div class="mb-8">
                    <div class="text-zinc-700 dark:text-zinc-300 mb-6">
                        <p class="text-lg italic">{{ $work->excerpt }}</p>
                    </div>
                    
                    <div class="prose prose-zinc dark:prose-invert max-w-none">
                        {!! nl2br(e($work->content)) !!}
                    </div>
                </div>
                
                <div class="border-t border-zinc-200 dark:border-zinc-700 pt-6">
                    <div class="flex items-center space-x-4">
                        @auth
                            @if (!$hasRated)
                                <flux:button wire:click="rate('up')" variant="ghost" size="sm">
                                    <flux:icon.hand-thumb-up class="w-4 h-4 mr-1" />
                                    <span>{{ $work->up_ratings }}</span>
                                </flux:button>
                                <flux:button wire:click="rate('down')" variant="ghost" size="sm">
                                    <flux:icon.hand-thumb-down class="w-5 h-5 mr-1" />
                                    <span>{{ $work->down_ratings }}</span>
                                </flux:button>
                            @else
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">
                                    <span class="flex items-center">
                                        <flux:icon.hand-thumb-up class="w-5 h-5 mr-1" />
                                        <span>{{ $work->up_ratings }}</span>
                                    </span>
                                </div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">
                                    <span class="flex items-center">
                                        <flux:icon.hand-thumb-down class="w-5 h-5 mr-1" />
                                        <span>{{ $work->down_ratings }}</span>
                                    </span>
                                </div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400 ml-2">
                                    You've already rated this work
                                </div>
                            @endif
                        @else
                            <div class="text-sm text-zinc-500 dark:text-zinc-400">
                                <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                    Log in to rate this work
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
