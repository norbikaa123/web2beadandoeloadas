<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Csak admin szerepű felhasználó érheti el az admin felületet.
     */
    protected function ensureAdmin(): void
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403); // Forbidden
        }
    }

    /**
     * Admin dashboard – felhasználók listája.
     */
    public function dashboard()
    {
        $this->ensureAdmin();

        $users = User::orderBy('id', 'desc')->paginate(20);

        return view('admin.dashboard', compact('users'));
    }

    public function setRole(User $user, Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'role' => ['required', 'in:admin,registered'],
        ]);

        $user->role = $validated['role'];
        $user->save();

        return redirect()
            ->route('admin.dashboard')
            ->with('status', 'A felhasználó szerepe frissítve lett.');
    }
}
