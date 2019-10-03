<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submission;
use Response; // for export method

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // * Authentication is required to run any method in this Controller
        $this->middleware('auth'); 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Submission $submission)
    {
        // $submissions = Submission::all();
        $submissions = $submission->orderBy('created_at', 'desc')->paginate(10);
        $total_count = $submission->count();
        $states = $submission->select('state')->distinct()->orderBy('state', 'asc')->get();
        session()->forget('filter'); // clear session when viewing all submissions
        return view('auth.home', compact('submissions', 'total_count', 'states'));
    }

    public function destroy(Submission $submission) {
        $submission->delete();
        return back()->with('success', 'Record deleted!');
    }

    public function edit(Submission $submission) {

        $statuses = [
            'closed',
            'hired',
            'interview',
            'pending',
        ]; 

        return view('auth.edit', compact('submission', 'statuses')); 
    }

    public function update(Submission $submission) {

        // dd('updated'); // for debugging
        // return request();

        // return $submission;
        $submission->update(request(['status', 'notes']));
        // return request();
        return back()->with('success', 'Record updated!');
    }

    public function show(Submission $submission) {

        $statuses = [
            'closed',
            'interview',
            'pending',
        ];

        return view('auth.edit', compact('submission', 'statuses')); 
        
    }

    public function export(Request $request, Submission $submission) {

        if( $request->has('from') && $request->has('to') ):
            if( $request->has('from') < $request->has('to') ):
                $date_from = $request->from;
                $date_to = $request->to;
                $submission = $submission->whereBetween("created_at", ["{$date_from} 00:00:00", "{$date_to} 23:59:59"]);
            else:
                return back()->with('error', 'Error! <strong>From</strong> date must be before <strong>To</strong> date');
            endif;
        endif;

        $table = $submission->get();

        $filename = "submissions.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array(
            'First Name', 
            'Last Name', 
            'City', 
            'State', 
            'Zip', 
            'Email', 
            'Phone', 
            'CDL-A',
            'Experience',
            'Submitted',
        ));

        foreach($table as $row) {
            fputcsv($handle, array(
                $row['first_name'], 
                $row['last_name'], 
                $row['city'],
                $row['state'],
                $row['zipcode'],
                $row['email'],
                $row['phone'],
                $row['cdla'],
                $row['experience'],
                $row['created_at'],
            ));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'submissions.csv', $headers);

    }
}
