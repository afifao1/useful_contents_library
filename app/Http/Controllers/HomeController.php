<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Content;

class HomeController extends Controller
{
    public function home(Request $request): View|Application|Factory
    {
        $query = Content::with('authors')->latest();

        if ($search = $request->input('search')) {
            $searchLower = strtolower($search);

            $query->where(function ($q) use ($searchLower) {
                $q->where(DB::raw('LOWER(title)'), 'like', '%' . $searchLower . '%')
                  ->orWhere(DB::raw('LOWER(description)'), 'like', '%' . $searchLower . '%');
            });
        }

        $contents = $query->get();

        return view('home', compact('contents'));
    }
}
