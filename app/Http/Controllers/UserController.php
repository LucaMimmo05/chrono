<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return "User Index";
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
