<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()

    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.user.index')->with('users', $users);
    }
}
