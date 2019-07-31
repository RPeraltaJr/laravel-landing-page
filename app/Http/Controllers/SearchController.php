<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Submission;

class SearchController extends Controller
{
    public function index() {
        $q = Input::get('q');

        $submissions = Submission::where('first_name','LIKE','%'.$q.'%')->orWhere('last_name','LIKE','%'.$q.'%')->paginate(5)->setPath('');
        $pagination = $submissions->appends(array(
            'q' => Input::get('q')
        ));

        if(count($submissions) > 0):
            // return $submission; // for debugging
            $total_count = Submission::where('first_name','LIKE','%'.$q.'%')->orWhere('last_name','LIKE','%'.$q.'%')->get()->count();
            return view('auth.home', compact('submissions', 'total_count'))->withQuery ( $q );
        else:
            $submissions = Submission::paginate(5);
            $total_count = Submission::count();
            return view('auth.home', compact('submissions', 'total_count'))->with("error", "No results found for <strong>{$q}</strong>. Try to search again!")->withQuery ( $q );
        endif;
    }
}
