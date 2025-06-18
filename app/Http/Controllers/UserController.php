<?php

namespace App\Http\Controllers;

use App\Exports\UsersPageExport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sortField', 'first_name');
        $sortDirection = $request->input('sortDirection', 'asc');
        $perPage = $request->input('perPage', 10);
        $page = $request->input('page', 1);

        $cacheKey = "users:$search:$sortField:$sortDirection:$page";

        $users = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($search, $sortField, $sortDirection, $perPage) {
            return User::query()
                ->when($search, function ($query) use ($search) {
                    $query->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%");
                })
                ->orderBy($sortField, $sortDirection)
                ->paginate($perPage);
        });

        return view('user-list', compact('users', 'search', 'sortField', 'sortDirection'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('update-user', compact('user'));
    }
    public function exportExcel(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sortField', 'first_name');
        $sortDirection = $request->input('sortDirection', 'asc');
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);

        $cacheKey = "users:$search:$sortField:$sortDirection:$page";

        $users = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($search, $sortField, $sortDirection, $perPage) {
            return User::query()
                ->when($search, function ($query) use ($search) {
                    $query->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                })
                ->orderBy($sortField, $sortDirection)
                ->paginate($perPage);
        });

        return Excel::download(new UsersPageExport($users), 'users_page_' . $page . '.csv');
    }

    public function show(User $user)
    {
        return view('show', compact('user'));
    }

    public function clearCache()
    {
        Cache::flush();
        return redirect()->route('users.index')->with('success', 'Cache cleared successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'occupation' => 'required|string|max:100',
            'status' => 'required|in:Active,Inactive,Suspended',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
}
