<?php

namespace App\Http\Controllers;

use App\Exports\UserWorklogsExport;
use App\Mail\UserSetPasswordMail;
use App\Models\User;
use App\Traits\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class UserManagementController extends Controller
{
    use LogActivity;

    public function index()
    {
        // Fetch all users, newest first
        $users = \App\Models\User::orderBy('id', 'desc')->get();

        // Pass users to the index view
        return view('admins.userManagement.index', compact('users'));
    }

    public function create()
    {
        return view('admins.userManagement.users');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'role'       => 'nullable|in:admin', // checkbox
        ]);

        // Create user WITHOUT password
        $user = \App\Models\User::create([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'email'      => $validated['email'],
            'role'       => isset($validated['role']) ? 'admin' : 'user',
            'password'   => '', // empty password
            'rfid_uid'   => null,
        ]);

        // Generate password reset token
        $token = \Illuminate\Support\Facades\Password::createToken($user);

        $resetUrl = url(route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ], false));

        // Send email with set-password link
        \Illuminate\Support\Facades\Mail::to($user->email)->send(
            new \App\Mail\UserSetPasswordMail($user, $resetUrl)
        );

        if (Auth::check()) {
            $this->logAction(Auth::id(), 'user_created', "Created user {$user->email}");
        }

        return redirect()
            ->route('admin.user.management')
            ->with('success', 'User created and invitation email sent.');
    }

        // Show edit form
    public function edit(User $user)
    {
        return view('admins.userManagement.edit', compact('user'));
    }

    // Handle update
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'role'       => 'nullable|in:admin',
            'rfid_uid'   => 'nullable|string|max:255',
        ]);

        $user->update([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'email'      => $validated['email'],
            'role'       => isset($validated['role']) ? 'admin' : 'user',
            'rfid_uid'   => $validated['rfid_uid'] ?? null,
        ]);

        $this->logAction(auth()->id, 'user_updated', "Updated user {$user->email}");

        if (Auth::check()) {
            $this->logAction(Auth::id(), 'user_updated', "Updated user {$user->email}");
        }

        return redirect()->route('admin.user.management')->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy(User $user)
    {
        if (Auth::check()) {
            $this->logAction(Auth::id(), 'user_deleted', "Deleted user {$user->email}");
        }
        $user->delete();
        return redirect()->route('admin.user.management')->with('success', 'User deleted successfully.');
    }
    
    public function sendPasswordLink(User $user)
    {
        // Generate password reset token
        $token = \Illuminate\Support\Facades\Password::createToken($user);

        $resetUrl = url(route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ], false));

        // Send email
        \Illuminate\Support\Facades\Mail::to($user->email)->send(
            new \App\Mail\UserSetPasswordMail($user, $resetUrl)
        );

        return redirect()
            ->back()
            ->with('success', 'Password setup link sent to user.');
    }

  public function export(Request $request)
    {
        $user = Auth::user(); // Current user
        $month = $request->get('month', now()->month);
        $year  = $request->get('year', now()->year);

        $filename = "worklogs_{$user->id}_{$year}_{$month}.xlsx";

        return FacadesExcel::download(
            new UserWorklogsExport($user, $month, $year),
            $filename
        );
    }
}
