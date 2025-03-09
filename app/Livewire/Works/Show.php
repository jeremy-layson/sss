<?php

namespace App\Livewire\Works;

use App\Models\Work;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Show extends Component
{
    public Work $work;
    public bool $hasRated = false;
    
    public function mount(Work $work)
    {
        if ($work->deleted_at) {
            abort(404);
        }
        
        $this->work = $work;
        
        if (Auth::check()) {
            $this->hasRated = Rating::where('user_id', Auth::id())
                ->where('work_id', $this->work->id)
                ->exists();
        }
    }
    
    public function rate($rating)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if ($this->hasRated) {
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
        return view('livewire.works.show');
    }
}
