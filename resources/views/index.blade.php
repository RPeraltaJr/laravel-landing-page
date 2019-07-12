@extends('layouts')

@section('content')
    <div class="row">
        <form action="" method="POST" class="col s6">
            @csrf
            <div class="row">
                <h3>Apply Now</h3>
                <p class="grey-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, dolorem ipsam blanditiis praesentium ipsum eaque repellendus sapiente, distinctio ullam, commodi optio.</p>
                @include('errors')
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="first_name" name="first_name" type="text" class="validate" required>
                    <label for="first_name">First Name*</label>
                </div>
                <div class="input-field col s6">
                    <input id="last_name" name="last_name" type="text" class="validate" required>
                    <label for="last_name">Last Name*</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" name="email" type="email" class="validate" required>
                    <label for="email">Email*</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="phone" name="phone" type="tel" class="validate" required>
                    <label for="phone">Phone*</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="message" name="message" class="materialize-textarea" required></textarea>
                    <label for="message">Message*</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button type="submit" class="waves-effect waves-light btn-large">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection