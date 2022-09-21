<h4 class="card-title">Discutez avec
    @if (Auth::user()->role == 'tuc')
    Votre Formatrice
    @endif
    @if (Auth::user()->role == 'tut')
    Votre Formatrice
    @endif
    @if (Auth::user()->role == 'tue')
    Votre Formatrice
    @endif
    @if (Auth::user()->role == 'formatrice')
    Le  Candidat
    @endif
    </h4>
<form action="{{ route('messages.update', $thread->id) }}" method="post">
    {{ method_field('put') }}
    {{ csrf_field() }}

    <div class="input-group">
        <textarea  name="message" class="form-control" placeholder="J'aimerais ajouter une expérience" aria-label="Ma Synthèse">{{ old('message') }}</textarea>
      </div>
      <br>
    <!-- Submit Form Input -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-control"><i class="bi bi-envelope-fill"></i> Envoyer</button>
    </div>
</form>
