<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TerminalController extends Controller
{
    // List all terminals
    public function index()
    {
        $terminals = Device::orderBy('id', 'desc')->get();
        return view('admins.terminals.index', compact('terminals'));
    }

    // Show create form
    public function create()
    {
        return view('admins.terminals.create');
    }

    // Store new terminal
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Device::create([
            'name' => $request->name,
            'api_token' => Str::random(60), // generate random API token
        ]);

        return redirect()->route('terminals.index')
            ->with('success', 'Terminal created successfully.');
    }

    // Show edit form
    public function edit(Device $terminal)
    {
        return view('admins.terminals.edit', compact('terminal'));
    }

    // Update terminal
    public function update(Request $request, Device $terminal)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $terminal->update([
            'name' => $request->name,
        ]);

        return redirect()->route('terminals.index')
            ->with('success', 'Terminal updated successfully.');
    }

    // Delete terminal
    public function destroy(Device $terminal)
    {
        $terminal->delete();

        return redirect()->route('terminals.index')
            ->with('success', 'Terminal deleted successfully.');
    }
}
