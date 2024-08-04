<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {

        $bonds = Auth::user()->prizeBond
            ->sortByDesc('id')
            ->groupBy('prefix');

        return view('dashboard', compact('bonds'));
    }
}
