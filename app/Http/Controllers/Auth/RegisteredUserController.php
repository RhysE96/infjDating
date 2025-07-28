<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_image' => 'required|image|max:2048',
            'looking_for_type' => 'required|array',
            'looking_for_type.*' => 'in:friendship,relationship',
            'looking_for_gender' => 'required|array',
            'looking_for_gender.*' => 'in:male,female',
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'birthdate' => 'required|date',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        } else {
            $imagePath = null;
        }
        // Automatically create a profile for this user
        $user->profile()->create([
            'name' => $request->input('name'),
            'profile_image' => $imagePath,
            'bio' => $request->input('bio'),
            'birthdate' => $request->input('birthdate'),
            'gender' => $request->input('gender'),
            'location_name' => $request->input('location_name'),
            'latitude' => '',
            'longitude' => '',
            'looking_for_type' => $request->input('looking_for_type'),
            'looking_for_gender' => $request->input('looking_for_gender'),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
