@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($submissions)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">City</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Zipcode</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">CDL-A</th>
                                    <th scope="col">Experience</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($submissions as $submission)
                                <tr>
                                    <th>{{ $submission->id }}</th>
                                    <th>{{ $submission->first_name }}</th>
                                    <th>{{ $submission->last_name }}</th>
                                    <th>{{ $submission->city }}</th>
                                    <th>{{ $submission->state }}</th>
                                    <th>{{ $submission->zipcode }}</th>
                                    <th>{{ $submission->email }}</th>
                                    <th>{{ $submission->phone }}</th>
                                    <th>{{ $submission->cdla }}</th>
                                    <th>{{ $submission->experience }}</th>
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
