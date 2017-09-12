<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // DB::enableQueryLog();

        // SELECT * FROM galleries WHERE user_id = $_SESSION['user_id']
        // $galleries = auth()->user()->galleries()->pluck('name', 'id');
        // dd($galleries);
        // dd(DB::getQueryLog());
        return view('home'); // ->with(compact('galleries'));
    }
}
