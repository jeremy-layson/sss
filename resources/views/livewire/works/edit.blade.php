<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white mb-6">Edit Work</h1>
                
                @if (session('message'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                        {{ session('message') }}
                    </div>
                @endif
                
                <form wire:submit="save" class="space-y-6">
                    <div>
                        <flux:input
                            wire:model="title"
                            label="Title"
                            placeholder="Enter the title of your work"
                            required
                        />
                    </div>
                    
                    <div>
                        <flux:textarea
                            wire:model="excerpt"
                            label="Excerpt"
                            placeholder="Write a short preview of your work (will be displayed in listings)"
                            rows="3"
                            required
                        />
                    </div>
                    
                    <div>
                        <flux:textarea
                            wire:model="content"
                            label="Content"
                            placeholder="Write your full work here"
                            rows="12"
                            required
                        />
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Cover Image</label>
                        
                        @if ($current_cover_image && !$remove_cover_image)
                            <div class="mb-4">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ Storage::url($current_cover_image) }}" alt="Current cover image" class="h-32 w-auto rounded">
                                    <flux:button wire:click="$set('remove_cover_image', true)" variant="danger" size="sm">
                                        Remove Image
                                    </flux:button>
                                </div>
                            </div>
                        @endif
                        
                        @if ($remove_cover_image || !$current_cover_image)
                            <flux:input
                                type="file"
                                wire:model="cover_image"
                                label="Upload New Cover Image (Optional)"
                                hint="Upload an image to represent your work (max 1MB)"
                                accept="image/*"
                            />
                            
                            @if ($cover_image)
                                <div class="mt-2">
                                    <img src="{{ $cover_image->temporaryUrl() }}" alt="New cover image preview" class="h-32 w-auto rounded">
                                </div>
                            @endif
                        @endif
                    </div>
                    
                    <div class="flex justify-between">
                        <flux:button :href="route('works.show', $work)" variant="secondary">
                            Cancel
                        </flux:button>
                        
                        <flux:button type="submit" variant="primary">
                            Update Work
                        </flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
