@if( isset($success) || session('success')  )
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        @if( isset($success) ) {!! $success !!} @else {!! session('success') !!} @endif
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif