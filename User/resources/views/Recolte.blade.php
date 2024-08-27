@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Recolte</h2>
            </div>
            <div class="py-3"></div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Calendrier des recoltes</div>
                    <div class="py-2"></div>
                <button id="switchToList" class="btn btn-primary" >Afficher en Liste</button>
                <button id="switchToGridMonth" class="btn btn-secondary">Afficher en Grille Mensuelle</button>
                <div class="py-3"></div>
                <div id='calendar'></div>
            </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.15/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/list@6.1.15/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/locales/fr.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                events: [
                        @foreach( $recoltes as $recolte )
                    {
                        title: "recolte {{ $recolte->camp }}",
                        start: '{{ $recolte->datestock }}',
                        url: '{{ route('DetailsRecolte',['id' => $recolte->id_stock])}} '
                    },
                    @endforeach
                ],
            });

            calendar.render();

            document.getElementById('switchToList').addEventListener('click', function() {
                calendar.changeView('listWeek');
            });

            document.getElementById('switchToGridMonth').addEventListener('click', function() {
                calendar.changeView('dayGridMonth');
            });
        });
    </script>
@endsection
