<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function show($id)
    {
        $user = User::with('parent', 'children')->findOrFail($id);

        $referrals = getAllReferrals($user);

        $totalReferrals = count($referrals);
        $totalIncome = calculateIncome($referrals);
        $maxLevel = collect($referrals)->max('level') ?? 0;

        return view('admin.users.show', compact(
            'user',
            'referrals',
            'totalReferrals',
            'totalIncome',
            'maxLevel'
        ));
    }
}
