@extends('Dashboard')
@section('content')
    <style>
        #map { height: 500px; }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>

    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Camp penal</h2>
                <a href="{{ route('Recensement') }}">
                    <button class="au-btn au-btn-icon au-btn--green">
                        <i class="fas fa-print"></i>PDF
                    </button>
                </a>
            </div>
            <div class="py-3"></div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title h3">Liste des camp penals</div>
                            <table id="example" class="table table-hover" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Superficie cultivees(ha)</th>
                                    <th>type de terre</th>
                                    <th> -- </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($camps as $camp)
                                    <tr>
                                        <td>{{ $camp->nom }}</td>
                                        <td>{{ $camp->superficie }}</td>
                                        <td>{{ $camp->sol }}</td>
                                        <td>
                                            <a href="{{ route('CampDetails', ['id' => $camp->id]) }}"><button class="btn btn-primary"><i class="fas fa-eye"></i> </button></a>
                                            @if(Auth::user()->usertype == 1 )
                                                <a href="{{ route('AjoutInfoCamp',['id' => $camp->id]) }}"><button class="btn btn-success" ><i class="fas fa-plus-circle"></i></button></a>
                                                <a href="{{ route('AjoutRecolte', ['id' => $camp->id]) }}"><button class="btn btn-success"><i class="fas fa-leaf"></i></button></a>
                                            @endif
                                            <a href="{{ route('Depense',['id' => $camp->id]) }}"><button class="btn btn-success"><i class="fas fa-money-bill-alt"></i> </button> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Carte interactif</div>
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        var map = L.map('map').setView([-18.913674, 47.529789], 6);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        @foreach($camps as $camp)
        L.marker([{{ $camp->lat }}, {{ $camp->lng }}]).addTo(map).bindPopup("<b>{{ $camp->nom }}</b><br>");
        {{--L.marker([{{ $camp->lat }}, {{ $camp->lng }}]).addTo(map).bindPopup("<b>{{ $camp->nom }}</b><br><a href=\"{{ route('DetailCamp', ['id' => $camp->id]) }}\">Details</a>");--}}
        @endforeach

    </script>
    <script>
        new DataTable('#example');
    </script>
@endsection
