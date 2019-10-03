@extends('layouts.app')

@section('content')

<form action="/submissions/{{ $submission->id }}" method="POST">
    @method('PATCH')
    @csrf

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                @include('shared.error')
                @include('shared.success')
                <a href="/admin" class="btn btn-secondary">View All</a>
                <hr>
            </div>

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <span class="text-secondary">Submitted at {{ $submission->created_at }}</span>
                    </div>
                    <div class="card-body">
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="first_name" class="text-secondary">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $submission->first_name }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="text-secondary">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $submission->last_name }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="city" class="text-secondary">City</label>
                                    <input type="text" name="city" id="city" class="form-control" value="{{ $submission->city }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="state" class="text-secondary">State</label>
                                    <input type="text" name="state" id="state" class="form-control" value="{{ $submission->state }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="zipcode" class="text-secondary">Zip Code</label>
                                    <input type="text" name="zipcode" id="zipcode" class="form-control" value="{{ $submission->zipcode }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="text-secondary">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $submission->email }}" disabled>
                        </div>
        
                        <div class="form-group">
                            <label for="cdla" class="text-secondary">Do you have your CDL-A?</label>
                            <input type="text" name="cdla" id="cdla" class="form-control" value="{{ $submission->cdla }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="experience" class="text-secondary">Do you have 1 year of driving experience in the last 10 years, <br>with 6 months experience within the last 2 years?</label>
                            <input type="text" name="experience" id="experience" class="form-control" value="{{ $submission->experience }}" disabled>
                        </div>
    
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status" class="text-secondary">Status</label>
                            <select name="status" id="status" class="form-control">
                                @if( $statuses ):
                                    @foreach( $statuses as $status):
                                        <option value="{{ $status }}" @if($submission->status == $status): selected @endif>
                                            {{ ucwords($status) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="notes" class="text-secondary">Notes</label>
                            <textarea name="notes" id="notes" cols="30" rows="10" class="form-control">{{ $submission->notes }}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</form>

@endsection
