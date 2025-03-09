<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        @if ($work)
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $work->title }}</h1>
                        <div class="text-sm text-zinc-500 dark:text-zinc-400">
                            By <span class="font-medium">{{ $work->user->pseudonym }}</span>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <div class="text-zinc-700 dark:text-zinc-300 mb-4">
                            <p class="italic text-lg">{{ $work->excerpt }}</p>
                        </div>
                        
                        @if ($work->cover_image)
                            <div class="mb-6">
                                <img src="{{ asset('storage/' . $work->cover_image) }}" alt="{{ $work->title }} cover image" class="w-full max-h-96 object-cover rounded-lg shadow-md">
                            </div>
                        @endif
                        
                        <div class="prose prose-zinc dark:prose-invert max-w-none">
                            {!! nl2br(e($work->content)) !!}
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center mt-8 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                        <div class="flex items-center space-x-4">
                            @auth
                                @if (!$hasRated)
                                    <flux:button wire:click="rate('up')" variant="ghost" size="sm">
                                        <flux:icon.hand-thumb-up class="w-5 h-5 mr-1" />
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
                        
                        <flux:button wire:click="nextWork" variant="primary">
                            Next Work
                        </flux:button>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md p-6 text-center">
                <p class="text-xl text-zinc-700 dark:text-zinc-300 mb-4">
                    No works available yet. Be the first to submit one!
                </p>
                
                @auth
                    <flux:button :href="route('works.create')" variant="primary">
                        Submit a Work
                    </flux:button>
                @else
                    <flux:button :href="route('login')" variant="primary">
                        Log in to Submit
                    </flux:button>
                @endauth
            </div>
        @endif
    </div>
</div>
