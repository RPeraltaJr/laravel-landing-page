@if( isset($error) || session('error')  )
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @if( isset($error) ) {!! $error !!} @else {!! session('error') !!} @endif
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif