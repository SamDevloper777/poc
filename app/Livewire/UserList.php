<?php

namespace App\Livewire;

use App\Exports\UsersPageExport;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class UserList extends Component
{

    public string $search = '';
    public string $sortField = 'first_name';
    public string $sortDirection = 'asc';
    public int $perPage = 10;

    protected $queryString = ['search', 'sortField', 'sortDirection', 'page'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function render()
    {
        $cacheKey = "users:{$this->search}:{$this->sortField}:{$this->sortDirection}:page:{$this->page}";

        $users = Cache::remember($cacheKey, now()->addMinutes(5), function () {
            return User::query()
                ->when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->where('first_name', 'like', "%{$this->search}%")
                          ->orWhere('last_name', 'like', "%{$this->search}%")
                          ->orWhere('email', 'like', "%{$this->search}%")
                          ->orWhere('phone', 'like', "%{$this->search}%")
                          ->orWhere('city', 'like', "%{$this->search}%")
                          ->orWhere('country', 'like', "%{$this->search}%");
                    });
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage);
        });

        return view('livewire.user-list', compact('users'));
    }
}
