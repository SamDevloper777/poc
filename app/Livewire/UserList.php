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
    use WithPagination;

    public string $search = '';
    public string $sortField = 'first_name';
    public string $sortDirection = 'asc';
    public int $perPage = 10;

    public $selectedUser = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'first_name'],
        'sortDirection' => ['except' => 'asc'],
        'perPage' => ['except' => 10],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatingPage()
    {
        $this->search = '';
    }
    public function exportCsv()
    {
        $page = $this->getPage();
        $filename = "users_page_{$page}.csv";

        return Excel::download(
            new UsersPageExport(
                $this->search,
                $this->sortField,
                $this->sortDirection,
                $this->perPage,
                $page
            ),
            $filename
        );
    }
    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortField === $field && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortField = $field;
        $this->resetPage();
    }

    public function showUser($userId)
    {
        $this->selectedUser = User::find($userId);
    }

    public function closeModal()
    {
        $this->selectedUser = null;
    }

    public function render()
    {
        $page = $this->getPage();
        $cacheKey = "users_{$this->search}_{$this->sortField}_{$this->sortDirection}_{$this->perPage}_page_{$page}";

        $users = Cache::remember($cacheKey, now()->addMinutes(5), function () {
            $query = User::query();

            if ($this->search) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                });
            }

            return $query->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage)
                ->withQueryString();
        });

        return view('livewire.user-list', compact('users'));
    }

    protected function getPage()
    {
        return request()->query('page', 1);
    }
}
