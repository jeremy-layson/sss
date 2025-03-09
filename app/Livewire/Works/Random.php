<?php

namespace App\Livewire\Works;

use App\Models\Work;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Random extends Component
{
    public ?Work $work = null;
    public bool $hasRated = false;
    
    public function mount()
    {
        $this->loadRandomWork();
    }
    
    public function loadRandomWork()
    {
        $this->work = Work::whereNull('deleted_at')
            ->inRandomOrder()
            ->first();
            
        if ($this->work && Auth::check()) {
            $this->hasRated = Rating::where('user_id', Auth::id())
                ->where('work_id', $this->work->id)
                ->exists();
        }
    }
    
    public function nextWork()
    {
        $this->loadRandomWork();
    }
    
    public function rate($rating)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if ($this->hasRated || !$this->work) {
            return;
        }
        
        Rating::create([
            'user_id' => Auth::id(),
            'work_id' => $this->work->id,
            'rating' => $rating
        ]);
        
        $this->hasRated = true;
    }
    
    public function render()
    {
        return view('livewire.works.random');
    }
}
