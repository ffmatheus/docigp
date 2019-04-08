<?php
namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;

class Home extends Controller
{
    public function index()
    {
        return redirect()->route('home.transparency');
    }

    public function transparency()
    {
        return view('public.home.index');
    }
}
