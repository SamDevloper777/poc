<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $sortField = $request->input('sortField', 'first_name');
        $sortDirection = $request->input('sortDirection', 'asc');
        $perPage = $request->input('perPage', 10);
        $page = $request->input('page', 1);

        $cacheKey = "users_{$search}_{$sortField}_{$sortDirection}_{$perPage}_page_{$page}";

        $users = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($search, $sortField, $sortDirection, $perPage) {
            return User::query()
                ->when($search, function ($query) use ($search) {
                    $query->where('first_name', 'like', "%{$search}%")
                          ->orWhere('last_name', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%");
                })
                ->orderBy($sortField, $sortDirection)
                ->paginate($perPage)
                ->withQueryString();
        });

        return view('user-list', compact('users', 'search', 'sortField', 'sortDirection', 'perPage'));
    }
}
