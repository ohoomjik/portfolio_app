<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function logout(Request $request) {
        auth()->logout();
        return redirect()->route('home');
    }

    public function login(Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('home');
    }

    return back()->withErrors([
        'email' => 'Неверные данные',
    ]);
}

    public function register(Request $request) {
        $incomingData = $request->validate([
            'name' => ['required', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:4', 'max:10'],
        ]);

        $user = User::create($incomingData);
        auth()->login($user);

        return redirect()->route('home');
    }

    // --- Admin methods ---

    public function adminList(Request $request)
    {
        $query = $request->get('search', '');

        $users = User::when($query, function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->get(['id', 'name', 'email', 'role', 'created_at']);

        return response()->json($users);
    }

    public function adminUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => ['required', Rule::unique('users', 'name')->ignore($id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json(['success' => true]);
    }

    public function adminDelete($id)
    {
        if ((int)$id === auth()->id()) {
            return response()->json(['error' => 'Нельзя удалить самого себя'], 403);
        }

        User::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }
}
