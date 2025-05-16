<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\Models\Content;


class HomeController extends Controller
{
    public function home(): View|Application|Factory
    {
        $contents = Content::with('authors')->latest()->get();
        return view('home', compact('contents'));
    }
}
