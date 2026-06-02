<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->paginate(20);

        return response()->json($users);
    }

    public function store()
    {
        return "User Store";
    }

    public function show($id)
    {
        return "User Show: " . $id;
    }

    public function update($id)
    {
        return "User Update: " . $id;
    }

    public function destroy($id)
    {
        return "User Destroy: " . $id;
    }
}
