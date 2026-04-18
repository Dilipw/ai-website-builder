<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function websites()
    {
        return view('dashboard.websites.index');
    }

    public function create()
    {
        return view('dashboard.websites.create');
    }

    public function show($id)
    {
        return view('dashboard.websites.show', compact('id'));
    }

    public function edit($id)
    {
        return view('dashboard.websites.edit', compact('id'));
    }
}
