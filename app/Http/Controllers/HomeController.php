<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submission;

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
        $submissions = Submission::all();
        return view('auth.home', compact('submissions'));
    }

    public function destroy(Submission $submission) {
        $submission->delete();
        return back();
    }
}
