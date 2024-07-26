@extends('Dashboard')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <style>
        #map{
            height: 500px;
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Camp pénal</h2>
            </div>
            <div class="py-3"></div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Details du camp pénal</div>
                    <div class="row">
                        <div class="col-lg-6">
                            <form>
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <div class="col-11">
                                            <label for="Nom" class="form-control-label">Nom</label>
                                            <input type="text" disabled id="Nom" name="nom" value="{{ $camps->nom }}" placeholder="Entrer le nom" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-11">
                                            <label for="superficie" class="form-control-label">Superficie (ha)</label>
                                            <input type="text"  disabled min="1" step="0.1" id="superficie" value="{{ $camps->superficie }}" name="superficie" placeholder="4,1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-11">
                                            <label for="province" class="form-control-label">Province</label>
                                            <input type="text"  disabled min="1" step="0.1" id="superficie" value="{{ $camps->province }}" name="superficie" placeholder="4,1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-11">
                                            <label for="sol" class="form-control-label">Type de sol</label>
                                            <input type="text"  disabled min="1" step="0.1" id="superficie" value="{{ $camps->sol }}" name="superficie" placeholder="4,1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="lat" class="form-control-label">Latitude</label>
                                                    <input type="text" disabled id="lat" name="lat" value="{{ $camps->lat }}" placeholder="-0.5978" class="form-control">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="lng" class="form-control-label">Longitude</label>
                                                    <input type="text" disabled id="lng" name="lng" value="{{ $camps->lng }}" placeholder="1.125" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-2"></div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6" id="map"></div>
                        <div class="py-4"></div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Liste des cultures</div>
                    <table class="table table-borderless tab">
                        <thead>
                        <th>Culutre</th>
                        <th>Supperficie</th>
                        </thead>
                        <tbody>
                        @foreach($cultures as $culture)
                            <tr>
                                <td>{{ $culture->culture }}</td>
                                <td>{{ $culture->superficie }} ha</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Liste des collaboteur</div>
                    <table class="table table-borderless tab">
                        <thead>
                        <th>Nom</th>
                        <th>Debut et fin de fonction</th>
                        <th>Details</th>
                        </thead>
                        <tbody>
                        @foreach($colabs as $colab)
                            <tr>
                                <td>{{ $colab->colab }}</td>
                                <td>{{ $colab->debut }} - {{ $colab->fin }}</td>
                                <td>{{ $colab->details }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
    <script>
        var popup = L.popup();

        // Initialisation de la carte
        var map = L.map('map').setView([{{ $camps->lat }}, {{ $camps->lng }}], 13);

        // Ajout de la couche de tuiles OpenStreetMap
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Ajouter un marqueur à la position du camp
        var marker = L.marker([{{ $camps->lat }}, {{ $camps->lng }}]).addTo(map)
            .bindPopup("Ici se situe le camp.")
            .openPopup();

    </script>
@endsection
