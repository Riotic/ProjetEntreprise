@extends('dashboard.home')

@section('main')
    <div style="display: flex; flex-direction: column;">
        @include('messenger.partials.flash')

        @each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads')
    </div>
    {{ $threads->links() }}
@stop

