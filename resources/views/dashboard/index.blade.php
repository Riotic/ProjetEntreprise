@extends('dashboard.home')

@section('main')

<div class=main_div>
    <div class="square">
        <div class="card">
            <div class="card-body">
                <h3><br> Présentation tutoriel de comment se servir de la plateforme en vidéo.</h3>
                @if (Auth::user())
                    @if (Auth::user()->role == 'formatrice')
                    <iframe width="100%" height="515" src="https://www.youtube.com/embed/GqVH1jfcboU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
