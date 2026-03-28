<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function dashboard()
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        if ($user->hasRole('user')) {

            $referrals = getAllReferrals($user);

            $totalReferrals = count($referrals);
            $totalIncome = calculateIncome($referrals);
            $maxLevel = collect($referrals)->max('level') ?? 0;

            return view('dashboard', compact(
                'totalReferrals',
                'totalIncome',
                'maxLevel',
                'referrals'
            ));
        }

        if ($user->hasRole('admin')) {

            $users = User::whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })->with('children')->get();

            $totalUsers = $users->count();

            $todayUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })->whereDate('created_at', today())->count();

            $totalReferrals = User::whereNotNull('parent_id')->count();

            $totalIncome = 0;

            foreach ($users as $u) {
                $refs = getAllReferrals($u);
                $totalIncome += calculateIncome($refs);
            }

            $recentUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })->latest()->take(5)->get();

            $recentReferrals = User::with('parent')
                ->whereNotNull('parent_id')
                ->latest()
                ->take(5)
                ->get();

            return view('dashboard', compact(
                'totalUsers',
                'todayUsers',
                'totalReferrals',
                'totalIncome',
                'recentUsers',
                'recentReferrals'
            ));
        }
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
