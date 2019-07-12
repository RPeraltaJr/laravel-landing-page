@if ($errors->any())
    <ul>
    @foreach ($errors->all() as $error)
        <li>
            <span class="red-text">&bull; {{ $error }}</span>
        </li>
    @endforeach
    </ul>
@endif