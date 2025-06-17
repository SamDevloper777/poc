<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{ use WithPagination;
      

    #[Url]
    public int $page = 1;

    #[Url]
    public string $search = '';

    #[Url]
    public string $sortField = 'first_name';

    #[Url]
    public string $sortDirection = 'asc';

    #[Url]
    public int $perPage = 10;

    public $selectedUser = null;

    public function updatedSearch()
    {
        $this->page = 1;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->page = 1;
    }

    public function showUser($userId)
    {
        $this->selectedUser = User::findOrFail($userId);
    }

    public function closeModal()
    {
        $this->selectedUser = null;
    }

    public function render()
    {
        $cacheKey = "users_{$this->search}_{$this->sortField}_{$this->sortDirection}_{$this->perPage}_page_{$this->page}";

        $users = Cache::remember($cacheKey, now()->addMinutes(5), function () {
            return User::where(function ($query) {
                $query->where('first_name', 'like', "%{$this->search}%")
                      ->orWhere('last_name', 'like', "%{$this->search}%")
                      ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage, ['*'], 'page', $this->page);
        });

        return view('livewire.user-list', [
            'users' => $users,
        ]);
    }
}
