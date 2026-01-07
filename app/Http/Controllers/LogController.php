<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
    $logs = \App\Models\Log::latest()->with('user')->get();
    return view('admins.logs.index', compact('logs'));
    }
}