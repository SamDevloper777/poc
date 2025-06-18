<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersPageExport implements FromView
{
    public $search, $sortField, $sortDirection, $perPage, $page;

    public function __construct($search, $sortField, $sortDirection, $perPage, $page)
    {
        $this->search = $search;
        $this->sortField = $sortField;
        $this->sortDirection = $sortDirection;
        $this->perPage = $perPage;
        $this->page = $page;
    }

    public function view(): View
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where('first_name', 'like', "%{$this->search}%")
                    ->orWhere('last_name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage, ['*'], 'page', $this->page);

        return view('exports.users', ['users' => $users]);
    }
}
