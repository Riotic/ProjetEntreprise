@extends('dashboard.home')

@section('main')

<div class=main_div>
    <div class="square">

        @if ((Auth::user()->role == 'admin') || (Auth::user()->role == 'formatrice') || (Auth::user()->role == 'informaticien'))
        <div class="col-md-12">
            <div class="info-box card">
                <div class="row card-body">
                    <div class="col-md-12">
                        <label for=""><br></label>
                        @if(Auth::user()->role == 'admin')
                        <input type="text" class="form-control lonf" id="search" name="search" value="" placeholder="Écrivez votre recherche">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3 class="title text"><br> Liste des Logs</h3>
                @if(Auth::user()->role == 'admin')
                <table class="table responsive">
                    <tbody id="tbody">
                        @php
                            $notifications = DB::select('SELECT * FROM notifications ORDER BY read_at DESC LIMIT 10');
                        @endphp
                        @forelse($notifications as $notification)
                            <tr>
                                <td>{{ date('l jS \of F Y h:i:s A', strtotime($notification->read_at) ) }}</td>
                                <td>{{$notification->type}}</td>
                                <td>{{$notification->notifiable_type}}</td>
                                <td><?php echo ($notification->data); ?></td>
                            </tr>
                        @empty
                            There are no new notifications
                        @endforelse
                    </tbody>
                </table>
                @endif
                @if(Auth::user()->role == 'formatrice')
                <table class="table responsive">
                    <tbody id="tbody">
                        @php
                            $notifications = DB::select('SELECT * FROM notifications ORDER BY read_at DESC LIMIT 10');
                        @endphp
                        @forelse($notifications as $notification)
                            <?php $pieces = explode("---", $notification->data);
                                    $creatorId = $pieces[1];
                            ?>
                            @if ($notification->notifiable_id == Auth::user()->id || $creatorId == Auth::user()->id)
                                <tr>
                                    <td>{{ date('l jS \of F Y h:i:s A', strtotime($notification->read_at) ) }}</td>
                                    <td>{{$notification->type}}</td>
                                    <td>{{$notification->notifiable_type}}</td>
                                    <td><?php echo ($notification->data); ?></td>
                                    <td><a href="/pdf/{{$notification->id}}" class="btn btn-primary waves-effect waves-float waves-green"><i class="bi bi-brush"></i> Exporter en PDF</a></td>
                                </tr>
                            @endif

                        @empty
                            There are no new notifications
                        @endforelse
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@if(Auth::user()->role == 'admin')

<script type="text/javascript">
    const search = document.getElementById('search');
    const tableBody = document.getElementById('tbody');

    function getContent() {
        const searchValue = search.value;
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '{{ route('search_log') }}/?search=' + searchValue, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                tableBody.innerHTML = xhr.responseText;
            }
        }
        xhr.send()
    }
    search.addEventListener('input', getContent);
</script>
@endif
@endsection
