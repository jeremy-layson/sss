<?php

namespace App\Livewire\Admin;

use App\Models\Work;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Works extends Component
{
    use WithPagination;
    
    public string $search = '';
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';
    public bool $showDeleted = false;
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingShowDeleted()
    {
        $this->resetPage();
    }
    
    public function deleteWork($id)
    {
        $work = Work::findOrFail($id);
        $work->delete();
        
        session()->flash('message', 'Work successfully deleted.');
    }
    
    public function restoreWork($id)
    {
        $work = Work::withTrashed()->findOrFail($id);
        $work->restore();
        
        session()->flash('message', 'Work successfully restored.');
    }
    
    public function render()
    {
        $query = Work::query();
        
        if ($this->showDeleted) {
            $query->withTrashed()->whereNotNull('deleted_at');
        } else {
            $query->whereNull('deleted_at');
        }
        
        $works = $query->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                        ->orWhereHas('user', function ($query) {
                            $query->where('pseudonym', 'like', '%' . $this->search . '%')
                                ->orWhere('name', 'like', '%' . $this->search . '%')
                                ->orWhere('email', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(15);
            
        return view('livewire.admin.works', [
            'works' => $works,
        ]);
    }
}
