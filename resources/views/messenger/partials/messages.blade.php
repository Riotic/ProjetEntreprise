
@php
    try {
        $nom = $message->user->name;
    } catch (Exception $e){
        $nom = 'User expiré';
        }
@endphp
<h2 class="accordion-header" id="flush-{{$message->id}}">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#div-{{$message->id}}" aria-expanded="false" aria-controls="{{$message->id}}">
        {{ $nom }}  - {{ ' '}} <code>              Envoyé {{ $message->created_at->diffForHumans() }} </code>
</button>
</h2>
<div id="div-{{$message->id}}" class="accordion-collapse collapse" aria-labelledby="flush-{{$message->id}}" data-bs-parent="#accordionFlushExample">
    <div class="accordion-body"> {{ $message->body }} </div>
</div>
