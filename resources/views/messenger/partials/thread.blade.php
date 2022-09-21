<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>

<div class="media alert col-md-6 {{ $class }}">
    <div class="card info-card customers-card">

        <div class="card-body">
            <h5 class="card-title">Messagerie {{ $thread->id }}<span>| {{Auth::user()->name}}</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-envelope-fill"></i>
                </div>
                <div class="ps-3">
                    <p><a href="{{ route('messages.show', $thread->id) }}">{{ $thread->subject }}</a> </p>
                     <span class="text-danger small pt-1 fw-bold">Écrivez </span> <span class="text-muted small pt-2 ps-1">à votre Formatrice</span><br>
                     <span class="text-info small">({{ $thread->userUnreadMessagesCount(Auth::id()) }} non lus)</span>

                </div>
            </div>

        </div>
    </div>
    {{-- <div class="card">
        <div class="card-body">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><br> Dernier Message</li>
            </ol>
                <p class="small fst-italic">
                    {{ $thread->latestMessage->body }}
                </p>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><br> Formatrice</li>
                </ol>
                    <small><strong>{{ $thread->creator()->name }}</strong></small>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><br>Participants</li>
                </ol>
                    <small><strong>{{ $thread->participantsString(Auth::id()) }}</strong></small>
        </div>
    </div> --}}
</div>
