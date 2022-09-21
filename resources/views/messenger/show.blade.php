@extends('dashboard.home')

@section('main')
    <div class="col-md-6">
        <h1>{{ $thread->subject }}</h1>
        @each('messenger.partials.messages', $thread->messages, 'message')
        @if (Auth::user()->role == 'tut')
            @php
                $synthstuts = DB::SELECT("SELECT id FROM `synthstuts` where status='3' and email='".Auth::user()->email."'");
            @endphp
            @if (count($synthstuts) < 1)
                @include('messenger.partials.form-message')
            @endif
        @endif
        @if (Auth::user()->role == 'tuc')
            @php
                $synthstucs = DB::SELECT("SELECT id FROM `synthstucs` where status='3' and email='".Auth::user()->email."'");
            @endphp
            @if (count($synthstucs) < 1)
                @include('messenger.partials.form-message')
            @endif
        @endif
        @if (Auth::user()->role == 'tue')
            @php
                $synthstues = DB::SELECT("SELECT id FROM `synthstues` where status='3' and email='".Auth::user()->email."'");
            @endphp
            @if (count($synthstues) < 1)
                @include('messenger.partials.form-message')
            @endif
        @endif
        @if (Auth::user()->role == 'formatrice')
            @include('messenger.partials.form-message')
        @endif
    </div>
@stop
