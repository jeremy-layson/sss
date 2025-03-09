<?php

namespace App\Livewire\Dashboard;

use App\Models\Work;
use Livewire\Component;

class Stats extends Component
{
    public function render()
    {
        $totalWorks = Work::count();
        
        return view('livewire.dashboard.stats', [
            'totalWorks' => $totalWorks,
        ]);
    }
}
