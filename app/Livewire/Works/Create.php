<?php

namespace App\Livewire\Works;

use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Layout('components.layouts.app')]
class Create extends Component
{
    use WithFileUploads;
    
    #[Rule('required|min:3|max:255')]
    public string $title = '';
    
    #[Rule('required|min:10|max:500')]
    public string $excerpt = '';
    
    #[Rule('required|min:50')]
    public string $content = '';
    
    #[Rule('nullable|image|max:1024')]
    public $cover_image = null;
    
    public function save()
    {
        $this->validate();
        
        $data = [
            'user_id' => Auth::id(),
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
        ];
        
        if ($this->cover_image) {
            $data['cover_image'] = $this->cover_image->store('cover-images', 'public');
        }
        
        $work = Work::create($data);
        
        session()->flash('message', 'Work successfully submitted!');
        
        return redirect()->route('works.show', $work);
    }
    
    public function render()
    {
        return view('livewire.works.create');
    }
}
