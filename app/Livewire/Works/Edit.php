<?php

namespace App\Livewire\Works;

use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Layout('components.layouts.app')]
class Edit extends Component
{
    use WithFileUploads;
    
    public Work $work;
    
    #[Rule('required|min:3|max:255')]
    public string $title = '';
    
    #[Rule('required|min:10|max:500')]
    public string $excerpt = '';
    
    #[Rule('required|min:50')]
    public string $content = '';
    
    #[Rule('nullable|image|max:1024')]
    public $cover_image = null;
    
    public string $current_cover_image = '';
    public bool $remove_cover_image = false;
    
    public function mount(Work $work)
    {
        if (Auth::id() !== $work->user_id) {
            abort(403, 'Unauthorized action.');
        }
        
        $this->work = $work;
        $this->title = $work->title;
        $this->excerpt = $work->excerpt;
        $this->content = $work->content;
        $this->current_cover_image = $work->cover_image ?? '';
    }
    
    public function save()
    {
        $this->validate();
        
        $data = [
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
        ];
        
        if ($this->remove_cover_image && $this->current_cover_image) {
            Storage::disk('public')->delete($this->current_cover_image);
            $data['cover_image'] = null;
        } elseif ($this->cover_image) {
            if ($this->current_cover_image) {
                Storage::disk('public')->delete($this->current_cover_image);
            }
            $data['cover_image'] = $this->cover_image->store('cover-images', 'public');
        }
        
        $this->work->update($data);
        
        session()->flash('message', 'Work successfully updated!');
        
        return redirect()->route('works.show', $this->work);
    }
    
    public function render()
    {
        return view('livewire.works.edit');
    }
}
