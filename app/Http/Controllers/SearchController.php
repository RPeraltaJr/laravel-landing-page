<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Submission;

class SearchController extends Controller
{
    public function filter(Request $request, Submission $submission) {

        // * get all states (BEFORE running filter query)
        $states = $submission->select('state')->distinct()->orderBy('state', 'asc')->get();

        // * queries
        if ($request->has('first_name')) {
            $submission = $submission->where('first_name', 'LIKE', "%{$request->first_name}%");
        }

        if ($request->has('last_name')) {
            $submission = $submission->where('last_name', 'LIKE', "%{$request->last_name}%");
        }

        if ($request->has('city')) {
            $submission = $submission->where('city', 'LIKE', "%{$request->city}%");
        }

        if ($request->has('state')) {
            $submission = $submission->where('state', 'LIKE', "%{$request->state}%");
        }

        if ($request->has('cdla')) {
            $submission = $submission->where('cdla', 'LIKE', "%{$request->cdla}%");
        }

        if ($request->has('experience')) {
            $submission = $submission->where('experience', 'LIKE', "%{$request->experience}%");
        }

        // * get result(s) count (BEFORE setting up pagination)
        $total_count = $submission->get()->count();

        // * setup pagination
        $submissions = $submission->orderBy('created_at', 'desc')->paginate(5)->setPath(''); // set pagination & limit

        // * enable pagination even after search filters
        $pagination = $submissions->appends ([
            'first_name' => Input::get('first_name'),
            'last_name' => Input::get('last_name'),
            'city' => Input::get('city'),
            'state' => Input::get('state') 
        ]);

        // * Route
        return view('auth.home', compact('submissions', 'total_count', 'states'));
        


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
