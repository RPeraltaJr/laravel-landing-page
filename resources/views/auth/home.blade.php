@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="" autocomplete="off">
                        <div class="form-row">
                            <div class="col-md-8">
                                <label for="q" class="sr-only">Search</label>
                                <input type="search" name="q" id="q" class="form-control" placeholder="Search by keyword">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-secondary btn-block">
                                    <span class="fa fa-search"></span> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-10 mt-4">

            <h3>{{ $total_count }} Results</h3>
            <hr>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($submissions)
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Timestamp</th>
                            <th>First</th>
                            <th>Last</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zipcode</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>CDL-A</th>
                            <th>Experience</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($submissions as $submission)
                        <tr>
                            <th>{{ $submission->created_at }}</th>
                            <th>{{ $submission->first_name }}</th>
                            <th>{{ $submission->last_name }}</th>
                            <th>{{ $submission->city }}</th>
                            <th>{{ $submission->state }}</th>
                            <th>{{ $submission->zipcode }}</th>
                            <th>{{ $submission->email }}</th>
                            <th>{{ $submission->phone }}</th>
                            <th>{{ $submission->cdla }}</th>
                            <th>{{ $submission->experience }}</th>
                            <th class="text-center">
                                <a href="submissions/{{ $submission->id }}/edit" class="btn btn-primary btn-sm" title="Edit">
                                    <span class="fa fa-edit">
                                        <span class="sr-only">Edit</span>
                                    </span>
                                </a>
                    
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteSubmission{{ $submission->id }}">
                                    <span class="fa fa-trash" title="Delete">
                                        <span class="sr-only">Delete</span>
                                    </span>
                                </button>

                                <!-- The Modal -->
                                <div class="modal" id="deleteSubmission{{ $submission->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        
                                            <!-- Modal Header -->
                                            <div class="modal-header" style="border-bottom: none">
                                                <h3 class="modal-title text-danger">Are you sure you want to delete?</h3>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="/delete/{{ $submission->id }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>

                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- Creates pagination -->
                {!! $submissions->render() !!} 
            @endif
            
        </div>

        <div class="col-md-10">
            <hr>
            <a href="/export" class="btn btn-secondary">
                <span class="fa fa-download"></span>&nbsp; 
                Export CSV
            </a>
        </div>

    </div>
</div>

@endsection
