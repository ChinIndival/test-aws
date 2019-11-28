<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function storeFile(Request $request)
    {
        $file = $request->img;
        $path = Storage::disk('s3')->putFile('/img', $file, 'public');

        return redirect()->back()->with('uploadSuccess', 'アップロードしました！');
    }
}
