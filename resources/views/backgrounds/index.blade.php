@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">All Backgrounds</h1>
        </div>

        <div class="gallery">

            @forelse($backgrounds as $background)
                <li>
                    <div class="thumbnail">
                        <img src="{{ $background->url('thumbnail') }}" alt=""/>
                        <a class="thumbnail__delete" href="{{ route('backgrounds.destroy', [$background->id]) }}" data-confirm="Are you sure you want to permanently delete this background?" data-method="DELETE"><span>delete</span></a>
                    </div>
                </li>
            @empty
                <div class="empty">No background images... yet!</div>
            @endforelse

        </div>

    </div>

    <div class="wrapper">
        <div class="row">
            <p><strong>You can add a new background to the rotation by uploading a file below.</strong> Upload a nice
            high-resolution copy of your image. It will be compressed and resized on the server.</p>
            @include('partials.errors')

            {!! Form::open(['route' => 'backgrounds.store', 'files' => true]) !!}
                {!! Form::file('image') !!}

                <div class="form-actions">
                    {!! Form::submit('Upload Background') !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
