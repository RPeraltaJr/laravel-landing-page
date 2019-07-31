<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Submission;

class SearchController extends Controller
{
    public function filter(Request $request, Submission $submission) {

        // $submissions = $submission->paginate(5);
        // $total_count = $submission->get()->count();

        if ($request->has('first_name')) {
            $submission = $submission->where('first_name', 'LIKE', "%{$request->first_name}%");
        }

        if ($request->has('last_name')) {
            $submission = $submission->where('last_name', 'LIKE', "%{$request->last_name}%");
        }

        if ($request->has('city')) {
            $submission = $submission->where('city', 'LIKE', "%{$request->city}%");
        }

        return $submission->get();

        


        // return view('auth.home', compact('submissions', 'total_count'));

        // $first_name = request('first_name');
        // $last_name = request('last_name');

        // $submissions = Submission::where('first_name', '=', $first_name)->where('last_name', '=', $last_name)->paginate(5);

        // if(count($submissions) > 0):
        //     // return $submission; // for debugging
        //     $total_count = Submission::where('first_name', '=', $first_name)->where('last_name', '=', $last_name)->get()->count();
        //     return view('auth.home', compact('submissions', 'total_count'))->withQuery("$first_name $last_name");
        // else:
        //     $submissions = Submission::paginate(5);
        //     $total_count = Submission::count();
        //     return view('auth.home', compact('submissions', 'total_count'))->with("error", "No results found for <strong>{$first_name} {$last_name}</strong>. Try to search again!")->withQuery("$first_name $last_name");
        // endif;

    }
}
