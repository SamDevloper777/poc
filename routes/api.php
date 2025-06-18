<?php

use App\Http\Controllers\Api\UserControllerApi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserControllerApi::class, 'login']);

Route::middleware('auth:sanctum')->get('/users', [UserControllerApi::class, 'index']);