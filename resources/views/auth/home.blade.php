@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div>

                <div>
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
                                    <th>
                                        <a href="submissions/{{ $submission->id }}/edit" class="btn btn-success btn-sm" title="View">
                                            <span class="fa fa-search">
                                                <span class="sr-only">View</span>
                                            </span>
                                        </a>
                                    </th>
                                    <th>
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
                                                            <button class="btn btn-danger">
                                                                <span class="fa fa-trash"></span> Delete
                                                            </button>
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
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
