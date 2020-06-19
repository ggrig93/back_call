@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="show-alert"></div>
        @if (session('limit_expired'))
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('limit_expired') }}
            </div>
        @endif

        @if(auth()->user()->hasRole(['manager']))
            @include('manager.requests_table')
        @else
            @include('user.request_form')
        @endif

    </div>
@endsection
