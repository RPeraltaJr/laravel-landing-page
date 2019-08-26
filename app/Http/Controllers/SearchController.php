<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Submission;

class SearchController extends Controller
{
    public function filter(Request $request, Submission $submission) {

        // * get all states (BEFORE running filter query) to display in front-end
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
        $sort = "created_at";
        $order = "desc";

        if( $request->has('sort') && $request->has('order') ) {
            $sort = $request->sort;
            $order = $request->order;
            $submission = $submission->orderBy($sort, $order);
        }

        $submissions = $submission->paginate(5)->setPath(''); // set pagination & limit

        // * enable pagination even after search filters
        $pagination = $submissions->appends ([
            'first_name' => Input::get('first_name'),
            'last_name' => Input::get('last_name'),
            'city' => Input::get('city'),
            'state' => Input::get('state'),
            'sort' => Input::get('sort'),
            'order' => Input::get('order'),
        ]);

        if( $request->first_name || $request->last_name || $request->city || $request->state || $request->cdla || $request->experience ) {
            // * Set a session when searching
            session(['filter' => true]); 
        }

        // * Route
        return view('auth.home', compact('submissions', 'total_count', 'states'));

    }
}
