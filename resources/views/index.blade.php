@extends('base')

@section('content')
    <div class="row">
        <form action="" method="POST" class="col-6 offset-3">
            @csrf
 
            <div class="form-group">
                <h2 class="text-primary">Apply Now</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, dolorem ipsam blanditiis praesentium ipsum eaque repellendus sapiente, distinctio ullam, commodi optio.</p>
                @include('errors')
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="first_name">First Name*</label>
                        <input id="first_name" class="form-control" name="first_name" type="text" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="col">
                        <label for="last_name">Last Name*</label>
                        <input id="last_name" class="form-control" name="last_name" type="text" value="{{ old('last_name') }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="city">City*</label>
                <input id="city" class="form-control" name="city" type="text" value="{{ old('city') }}" required>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="state">State*</label>
                        <select id="state" name="state" class="form-control" required>
                            <option value="" disabled selected>Select a State</option>
                            @if ($states)
                                @foreach ($states as $state)
                                    <option value="{{ $state }}" @if($state == old('state')): selected @endif>
                                        {{ $state }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col">
                        <label for="zipcode">Zipcode*</label>
                        <input id="zipcode" class="form-control" name="zipcode" type="text" maxlength="5" value="{{ old('zipcode') }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email*</label>
                <input id="email" class="form-control" name="email" type="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone*</label>
                <input id="phone" class="form-control" name="phone" type="tel" value="{{ old('phone') }}" required>
            </div>

            <div class="form-group">
                <label for="cdla">Do you have your CDL-A?*</label>
                <select id="cdla" name="cdla" class="form-control" required>
                    <option value="" disabled selected>Select</option>
                    <option value="Yes" @if(old('cdla') == 'Yes'): selected @endif>Yes</option>
                    <option value="No" @if(old('cdla') == 'No'): selected @endif>No</option>
                </select>
            </div>

            <div class="form-group">
                <label for="experience">Do you have 1 year of driving experience in the last 10 years, with 6 months experience within the last 2 years?*</label>
                <select id="experience" name="experience" class="form-control" required>
                    <option value="" disabled selected>Select</option>
                    <option value="Yes" @if(old('experience') == 'Yes'): selected @endif>Yes</option>
                    <option value="No" @if(old('experience') == 'No'): selected @endif>No</option>
                </select>
            </div>

            <div class="form-group">
                <p>
                    <label>
                        <input type="checkbox" value="1" name="confirm" required>
                        <span class="text-muted">By submitting this form you are opting in to receive correspondence from [COMPANY NAME]. This includes receiving autodialed telephone calls, prerecorded messages and emails about job opportunities at the contact number(s) I have provided above.</span>
                    </label>
                </p>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>

        </form>
    </div>
@endsection