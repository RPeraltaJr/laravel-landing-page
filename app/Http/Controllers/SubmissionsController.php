<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submission;

class SubmissionsController extends Controller
{
    public function index() {

        $states = [
            'AL'=>'Alabama',
            'AK'=>'Alaska',
            'AZ'=>'Arizona',
            'AR'=>'Arkansas',
            'CA'=>'California',
            'CO'=>'Colorado',
            'CT'=>'Connecticut',
            'DE'=>'Delaware',
            'DC'=>'District of Columbia',
            'FL'=>'Florida',
            'GA'=>'Georgia',
            'HI'=>'Hawaii',
            'ID'=>'Idaho',
            'IL'=>'Illinois',
            'IN'=>'Indiana',
            'IA'=>'Iowa',
            'KS'=>'Kansas',
            'KY'=>'Kentucky',
            'LA'=>'Louisiana',
            'ME'=>'Maine',
            'MD'=>'Maryland',
            'MA'=>'Massachusetts',
            'MI'=>'Michigan',
            'MN'=>'Minnesota',
            'MS'=>'Mississippi',
            'MO'=>'Missouri',
            'MT'=>'Montana',
            'NE'=>'Nebraska',
            'NV'=>'Nevada',
            'NH'=>'New Hampshire',
            'NJ'=>'New Jersey',
            'NM'=>'New Mexico',
            'NY'=>'New York',
            'NC'=>'North Carolina',
            'ND'=>'North Dakota',
            'OH'=>'Ohio',
            'OK'=>'Oklahoma',
            'OR'=>'Oregon',
            'PA'=>'Pennsylvania',
            'RI'=>'Rhode Island',
            'SC'=>'South Carolina',
            'SD'=>'South Dakota',
            'TN'=>'Tennessee',
            'TX'=>'Texas',
            'UT'=>'Utah',
            'VT'=>'Vermont',
            'VA'=>'Virginia',
            'WA'=>'Washington',
            'WV'=>'West Virginia',
            'WI'=>'Wisconsin',
            'WY'=>'Wyoming',
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
            'first_name'    => ['required', 'min:3', 'max:255', 'regex:/^[a-zA-Z\s]*$/'], // only letters & spaces allowed
            'last_name'     => ['required', 'min:3', 'max:255', 'regex:/^[a-zA-Z\s]*$/'],
            'city'          => ['required', 'min:3', 'regex:/^[a-zA-Z\s]*$/'],
            'state'         => ['required', 'min:2', 'max:2', 'regex:/^[a-zA-Z\s]*$/'],
            'zipcode'       => ['required', 'min:5', 'max:5'],
            'email'         => ['required', 'min:3', 'max:255'],
            'phone'         => ['required', 'min:10'],
            'cdla'          => ['required', 'min:2'],
            'experience'    => ['required', 'min:2'],
            'confirm'       => ['required', 'min:1', 'max:1']
        ]);

        // format the data
        $attributes['first_name'] = cleanInput($attributes['first_name']);
        $attributes['last_name'] = cleanInput($attributes['last_name']);
        $attributes['city'] = cleanInput($attributes['city']);
        $attributes['state'] = strtoupper(cleanInput($attributes['state']));
        $attributes['email'] = strtolower(cleanInput($attributes['email']));
        $attributes['cdla'] = cleanInput($attributes['cdla']);
        $attributes['experience'] = cleanInput($attributes['experience']);

        // update or create (to prevent duplicate entries)
        Submission::updateOrCreate($attributes);
        return redirect('/thank-you');
        
    }
}
