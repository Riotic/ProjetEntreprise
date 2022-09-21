<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="/index" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Synthèse Bilan de compétences</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Connectez-vous à votre compte</h5>
                    <p class="text-center small">Entrez votre email et votre mot de passe pour vous connecter</p>
                  </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                  <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('login') }}">
                      @csrf

                    <div class="col-12"> <label for="yourUsername"
                      class="form-label">E-mail</label> <div
                      class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text"  class="form-control"  name="email" placeholder="Email" :value="old('email')" required autofocus >
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" class="form-control"  type="password" name="password" placeholder="Mot de passe" required autocomplete="current-password">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input  class="form-check-input"  id="remember_me" type="checkbox" name="remember">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">


                    <x-button class="btn-primary w-100">
                                {{ __('Log in') }}
                    </x-button>
                    </div>

                  </form>

                </div>
              </div>

              <div class="credits">
                Designed by <a href=" /">Bilan de compétences</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
