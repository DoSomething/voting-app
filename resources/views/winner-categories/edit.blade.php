@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">Edit Winner Category: {{ $winnerCategory->name }}</h1>

            <p>Changing the name of a winner category will not change its URL.</p>
        </div>

        @include('partials.errors')

        {!! Form::model($winnerCategory, ['method' => 'PUT', 'route'=> ['winner-categories.update', $winnerCategory->slug]]) !!}
            @include('winner-categories.form')
            {!! Form::submit('Update Winner Category') !!}
        {!! Form::close() !!}
    </div>

    <div class="wrapper">
        <p>If this winner category is no longer wanted, you may delete it. All candidates within this category must be deleted or moved into another category first.</p>
        <div class="form-actions">
            <a href="{{ route('winner-categories.destroy', [$winnerCategory->slug]) }}" data-method="DELETE" data-confirm="Are you sure you want to delete this category?" class="button -danger">Delete Category</a>
        </div>
    </div>
@stop
