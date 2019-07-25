<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submission;

class SubmissionsController extends Controller
{
    public function index() {

        $states = [
            'Alabama',
            'Alaska',
            'Arizona',
            'Arkansas',
            'California',
            'Colorado',
            'Connecticut',
            'Delaware',
            'District of Columbia',
            'Florida',
            'Georgia',
            'Hawaii',
            'Idaho',
            'Illinois',
            'Indiana',
            'Iowa',
            'Kansas',
            'Kentucky',
            'Louisiana',
            'Maine',
            'Maryland',
            'Massachusetts',
            'Michigan',
            'Minnesota',
            'Mississippi',
            'Missouri',
            'Montana',
            'Nebraska',
            'Nevada',
            'New Hampshire',
            'New Jersey',
            'New Mexico',
            'New York',
            'North Carolina',
            'North Dakota',
            'Ohio',
            'Oklahoma',
            'Oregon',
            'Pennsylvania',
            'Rhode Island',
            'South Carolina',
            'South Dakota',
            'Tennessee',
            'Texas',
            'Utah',
            'Vermont',
            'Virginia',
            'Washington',
            'West Virginia',
            'Wisconsin',
            'Wyoming'
        ];

        return view('index', compact('states'));
    }

    public function store() {

        function cleanInput($data) {
            $data = ucwords(strtolower($data));
            $data = trim($data); // remove whitespaces from both sides of a string
            $data = stripslashes($data); // removes backslashes
            $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // converts some predefined characters to HTML entities (ex. & to &amp;)
            return $data;
        }

        // validations
        $attributes = request()->validate([
            'first_name'    => ['required', 'min:3', 'max:255'],
            'last_name'     => ['required', 'min:3', 'max:255'],
            'city'          => ['required', 'min:3'],
            'state'         => ['required', 'min:4'],
            'zipcode'       => ['required', 'min:5', 'max:5'],
            'email'         => ['required', 'min:3', 'max:255'],
            'phone'         => ['required', 'min:10'],
            'cdla'          => ['required', 'min:2'],
            'experience'    => ['required', 'min:2'],
            'confirm'       => ['required']
        ]);

        // format the data
        $attributes['first_name'] = cleanInput($attributes['first_name']);
        $attributes['last_name'] = cleanInput($attributes['last_name']);
        $attributes['city'] = cleanInput($attributes['city']);
        $attributes['state'] = cleanInput($attributes['state']);
        $attributes['email'] = strtolower(cleanInput($attributes['email']));
        $attributes['cdla'] = cleanInput($attributes['cdla']);
        $attributes['experience'] = cleanInput($attributes['experience']);

        // update or create (to prevent duplicate entries)
        Submission::updateOrCreate($attributes);
        return redirect('/thank-you');
        
    }
}
