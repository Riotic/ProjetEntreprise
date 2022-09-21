<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    @auth
    <?php $roles = Auth::user()->role; ?>
    @endauth
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="/index">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->
        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link  @if(Route::currentRouteName() == 'users.show') good @else collapsed @endif" href="{{ route('users.show', Auth::user()->id) }}">
                <i class="bi bi-person"></i>
                <span>Profil : <span class="name-pre">{{ Auth::user()->name }}, {{ Auth::user()->surname }}</span></span>
            </a>
        </li>
        <!-- End F.A.Q Page Nav -->
        @if ($roles == 'formatrice')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/synthstucs/create') }}">
                <img src="https://bilan.trouver-un-candidat.com/wp-content/uploads/2022/04/cropped-icon-32x32.png" alt="" srcset="">
                <span>Création TUC</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/synthstues/create') }}">
                <img src="http://trouver-un-expert.com/wp-content/uploads/2022/08/cropped-T1Exp-logo-removebg-preview.png" width="32px" alt="" srcset="">
                <span>Création TUE</span>
            </a>
        </li>
        <!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/synthstuts/create') }}">
                <img src="https://trouver-un-therapeute.fr/wp-content/uploads/2021/08/cropped-Symbole-complet-couleur-bleu-uni-sansfond.png" style="width: 32px" alt="" srcset="">
                <span>Création TUT</span>
            </a>
        </li>
        <!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link"  href="{{ route('users.indexTUC', Auth::user()->id) }}">
                <img src="https://bilan.trouver-un-candidat.com/wp-content/uploads/2022/04/cropped-icon-32x32.png" alt="" srcset="">
                <span>Mes créations TUC</span>
            </a>
        </li>
        <!-- End Login Page Nav -->

        <li class="nav-item">
            <a class="nav-link"  href="{{ route('users.indexTUE', Auth::user()->id) }}">
                <img src="http://trouver-un-expert.com/wp-content/uploads/2022/08/cropped-T1Exp-logo-removebg-preview.png" width="32px" alt="" srcset="">
                <span>Mes créations TUE</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.indexTUT', Auth::user()->id) }}">
                <img src="https://trouver-un-therapeute.fr/wp-content/uploads/2021/08/cropped-Symbole-complet-couleur-bleu-uni-sansfond.png" style="width: 32px"  alt="" srcset="">
                <span>Mes créations TUT</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.indexUserCreated', Auth::user()->id) }}">
                <i class="bi bi-people"></i>
                <span>Mes clients</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('messages') }}">
                <i class="bi bi-envelope"></i>
                <span>Ma messagerie</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin') }}">
                <i class="bi bi-book"></i>
                <span>Logs</span>
            </a>
        </li>
        @endif

        @if (Auth::user()->role == 'tuc')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ma_synthes_tuc') }}">
                    <img src="https://bilan.trouver-un-candidat.com/wp-content/uploads/2022/04/cropped-icon-32x32.png" alt="LogoTU" srcset="">
                    <span>Ma Synthèse</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('messages') }}">
                    <i class="bi bi-envelope"></i>
                    <span>Ma messagerie</span>
                </a>
            </li>
            @php
                $synthstucs = DB::SELECT("SELECT id FROM `synthstucs` where status='3' and email='".Auth::user()->email."'");
            @endphp
            @if (count($synthstucs) < 1)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('validation') }}">
                    <i class="bi bi-save2-fill"></i>
                    <span>Valider votre Synthèse</span>
                </a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link collapsed" href="javascript:void(downloadSynthese())">
                    <i class="bi bi-save2-fill"></i>
                    <input type="hidden" id="role_user" name="" value="{{Auth::user()->role}}">
                    <span>Téléchargez mon attestation</span>
                </a>
            </li>
            @endif
        @endif

        @if (Auth::user()->role == 'tue')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('ma_synthes_tue') }}">
                <img src="http://trouver-un-expert.com/wp-content/uploads/2022/08/cropped-T1Exp-logo-removebg-preview.png" width="32px" alt="LogoTU" srcset="">
                <span>Ma Synthèse</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('messages') }}">
                <i class="bi bi-envelope"></i>
                <span>Ma messagerie</span>
            </a>
        </li>
        @php
            $synthstues = DB::SELECT("SELECT id FROM `synthstues` where status='3' and email='".Auth::user()->email."'");
        @endphp
        @if (count($synthstues) < 1)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('validation') }}">
                <i class="bi bi-save2-fill"></i>
                <span>Valider votre Synthèse</span>
            </a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(downloadSynthese())">
                <i class="bi bi-save2-fill"></i>
                <input type="hidden" id="role_user" name="" value="{{Auth::user()->role}}">
                <span>Téléchargez mon attestation</span>
            </a>
        </li>
            @endif
        @endif

        @if ($roles == 'tut')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ma_synthese_tut') }}">
                    <img src="https://trouver-un-therapeute.fr/wp-content/uploads/2021/08/cropped-Symbole-complet-couleur-bleu-uni-sansfond.png" style="width: 32px"  alt="" srcset="">
                    <span>Ma Synthèse</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('messages') }}">
                    <i class="bi bi-envelope"></i>
                    <span>Ma messagerie</span>
                </a>
            </li>
            @php
                $thread_id = DB::SELECT("SELECT id FROM `synthstuts` where status='3' and email='".Auth::user()->email."'");
            @endphp
            @if (count($thread_id) < 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('validation') }}">
                        <i class="bi bi-save2-fill"></i>
                        <span>Valider votre Synthèse</span>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link collapsed" href="javascript:void(downloadSynthese())">
                        <i class="bi bi-save2-fill"></i>
                        <span>Téléchargez mon attestation</span>
                    </a>
                </li>
            @endif

        @endif

        @if ($roles == 'admin')

        <li class="nav-item">
            <a class="nav-link" href="{{ route('synthstucs.index') }}">
                <img src="https://bilan.trouver-un-candidat.com/wp-content/uploads/2022/04/cropped-icon-32x32.png" alt="LogoTU" srcset="">
                <span>Visualiser créations TUC</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('synthstues.index') }}">
                <img src="http://trouver-un-expert.com/wp-content/uploads/2022/08/cropped-T1Exp-logo-removebg-preview.png" width="32px" alt="LogoTU" srcset="">
                <span>Visualiser créations TUE</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('synthstuts.index') }}">
                <img src="https://trouver-un-therapeute.fr/wp-content/uploads/2021/08/cropped-Symbole-complet-couleur-bleu-uni-sansfond.png" style="width: 32px"  alt="LogoTU" srcset="">
                <span>Visualiser créations TUT</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="bi bi-people"></i>
                <span>Visualiser Users</span>
            </a>
        </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.create') }}">
                    <i class="bi bi-people"></i>
                    <span>Créer un compte </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin') }}">
                    <i class="bi bi-book"></i>
                    <span>Logs</span>
                </a>
            </li>

        @endif
        <!-- End Error 404 Page Nav -->
        <li class="nav-item">
            <form id="logout" method="POST" action="{{ route('logout') }}">
                @csrf
                <input type="hidden" value="{{ Auth::user()->online = 0 }}" name="online">

                <a class="nav-link collapsed " :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i style="color: red;" class="bi bi-box-arrow-right"></i> {{ __('Log Out') }}
                </a>
            </form>
        </li>
        <!-- End Blank Page Nav -->

    </ul>

</aside>
<!-- End Sidebar-->
<script>
    function downloadSynthese() {
        swal({
            title: "Télécharger votre synthèse",
            text: "Vous pouvez sauvegarder dans votre appareil !",
            icon: "info",
            buttons: [
                'Non annuler .',
                'Maintenant !'
            ],
            dangerMode: false,
            }).then(function(isConfirm) {
            if (isConfirm) {
                GetDownload();
                swal({
                title: 'Téléchargez !',
                text: 'Vous avez accès à votre Synthèse !',
                icon: 'success'
                }).then(function() {
                    form.submit();
                });
            } else {
                swal("Annulez ", "Vous pouvez le faire .", "error");
            }
            });
    }
    function GetDownload() {
        window.location.href = '/downloadPDF';
    }
</script>
