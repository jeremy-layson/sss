<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white mb-6">Submit a New Work</h1>
                
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
                        <flux:input
                            type="file"
                            wire:model="cover_image"
                            label="Cover Image (Optional)"
                            hint="Upload an image to represent your work (max 1MB)"
                            accept="image/*"
                        />
                        
                        @if ($cover_image)
                            <div class="mt-2">
                                <img src="{{ $cover_image->temporaryUrl() }}" alt="Cover image preview" class="h-32 w-auto rounded">
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex justify-end">
                        <flux:button type="submit" variant="primary">
                            Submit Work
                        </flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
