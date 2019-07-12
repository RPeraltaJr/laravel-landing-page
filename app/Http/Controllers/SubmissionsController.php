<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submission;

class SubmissionsController extends Controller
{
    public function index() {
        return view('index');
    }

    public function store() {

        // validations
        $attributes = request()->validate([
            'first_name'    => ['required', 'min:3', 'max:255'],
            'last_name'     => ['required', 'min:3', 'max:255'],
            'email'         => ['required', 'min:3', 'max:255'],
            'phone'         => ['required', 'min:3'],
            'message'       => ['required', 'min:3'],
        ]);

        // format the data
        $attributes['first_name'] = ucfirst($attributes['first_name']);
        $attributes['last_name'] = ucfirst($attributes['last_name']);
        $attributes['email'] = strtolower($attributes['email']);

        // update or create (to prevent duplicate entries)
        Submission::updateOrCreate($attributes);
        return redirect('/thank-you');
        
    }
}
