@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-md-11">
            @include('shared.error')
            @include('shared.success')
        </div>

        <div class="col-md-6">
            <div class="card collapse @if(session('filter')) show @endif" id="filter">
                <div class="card-body">
                    <form action="/admin/search" method="GET" autocomplete="off" role="search">
                        
                        <div class="form-row">
                            <div class="col-md-12">
                                <h4>Filter</h4>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mt-2">
                                <label for="first_name" class="sr-only">First Name</label>
                                <input type="search" name="first_name" id="first_name" 
                                    class="form-control @if( request('first_name') ) border-success @endif" 
                                    @if( request('first_name') ) value="{{ request('first_name') }}" @endif placeholder="First name">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="last_name" class="sr-only">Last Name</label>
                                <input type="search" name="last_name" id="last_name" 
                                    class="form-control @if( request('last_name') ) border-success @endif"  
                                    @if( request('last_name') ) value="{{ request('last_name') }}" @endif placeholder="Last name">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="city" class="sr-only">City</label>
                                <input type="search" name="city" id="city" 
                                    class="form-control @if( request('city') ) border-success @endif" 
                                    @if( request('city') ) value="{{ request('city') }}" @endif placeholder="City">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="state" class="sr-only">Select a State</label>
                                <select name="state" id="state" class="form-control @if( request('state') ) border-success @endif">
                                    <option value="" selected readonly>Select a State</option>
                                    @if ($states)
                                        @foreach ($states as $abbr)
                                            <option value="{{ $abbr->state }}" @if( request('state') == $abbr->state ) selected @endif>
                                                {{ $abbr->state }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="cdla" class="sr-only">CDL-A</label>
                                <select name="cdla" id="cdla" class="form-control @if( request('cdla') ) border-success @endif">
                                    <option value="" selected readonly>CDL-A?</option>
                                    <option value="Yes" @if( request('cdla') == 'Yes' ): selected @endif>Yes</option>
                                    <option value="No" @if( request('cdla') == 'No' ): selected @endif>No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="cdla" class="sr-only">Experience</label>
                                <select name="experience" id="experience" class="form-control @if( request('experience') ) border-success @endif">
                                    <option value="" selected readonly>Experience?</option>
                                    <option value="Yes" @if( request('experience') == 'Yes' ): selected @endif>Yes</option>
                                    <option value="No" @if( request('experience') == 'No' ): selected @endif>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-12">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <button class="btn btn-secondary btn-block">
                                            <span class="fa fa-search"></span> Search
                                        </button>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="/admin/" class="btn">Clear</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card collapse @if(session('export')) show @endif"" id="export">
                <div class="card-body">
                    <form action="/export" method="GET" autocomplete="off" role="search">
                        <div class="form-row">
                            <div class="col-md-12">
                                <h4>Export</h4>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="export_from">From</label>
                                <input type="text" name="from" id="export_from" class="form-control" placeholder="MM/DD/YYYY" required>
                            </div>
                            <div class="col-md-6">
                                <label for="export_to">To</label>
                                <input type="text" name="to" id="export_to" class="form-control" placeholder="MM/DD/YYYY" required>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-12">
                                <ul class="list-inline">
                                    <li class="list-inline-item"">
                                        <button class="btn btn-secondary">
                                            <span class="fa fa-download"></span> &nbsp;Export CSV
                                        </button>
                                    </li>
                                    <li class="list-inline-item"">
                                        <a href="/export" class="btn">Export All</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-11 mt-4">

            @if ($submissions)
                <h3>
                    {{ $total_count }} 
                    @if(isset($total_count) && $total_count > 1) Results @else Result @endif 
                    @if( !isset($error) )
                        @if(isset($query)) for <strong class="text-primary">{{ $query }}</strong> @endif
                    @endif
                </h3>
                <hr>
            @endif

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($submissions)
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>
                                <a href="{{ sort_order('id', request('order')) }}">
                                    ID {!! sort_arrow('id', request('sort'), request('order')) !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{ sort_order('first_name', request('order')) }}">
                                    First {!! sort_arrow('first_name', request('sort'), request('order')) !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{ sort_order('last_name', request('order')) }}">
                                    Last {!! sort_arrow('last_name', request('sort'), request('order')) !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{ sort_order('city', request('order')) }}">
                                    City {!! sort_arrow('city', request('sort'), request('order')) !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{ sort_order('state', request('order')) }}">
                                    State {!! sort_arrow('state', request('sort'), request('order')) !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{ sort_order('zipcode', request('order')) }}">
                                    Zip {!! sort_arrow('zipcode', request('sort'), request('order')) !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{ sort_order('email', request('order')) }}">
                                    Email {!! sort_arrow('email', request('sort'), request('order')) !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{ sort_order('phone', request('order')) }}">
                                    Phone {!! sort_arrow('phone', request('sort'), request('order')) !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{ sort_order('cdla', request('order')) }}">
                                    CDL-A {!! sort_arrow('cdla', request('sort'), request('order')) !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{ sort_order('experience', request('order')) }}">
                                    Experience {!! sort_arrow('experience', request('sort'), request('order')) !!}
                                </a>
                            </th>
                            <th>
                                <a href="{{ sort_order('created_at', request('order')) }}">
                                    Timestamp {!! sort_arrow('created_at', request('sort'), request('order')) !!}
                                </a>
                            </th>
                            <th></th>
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
                            <th>{{ $submission->created_at->format('m-d-Y') }}</th>
                            <th class="text-center">
                                <a href="/submissions/{{ $submission->id }}/edit" class="btn btn-primary btn-sm" title="Edit">
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
                                                <form action="/submissions/{{ $submission->id }}" method="POST">
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
                <hr>
            @endif
            
        </div>

    </div>
</div>

@endsection
