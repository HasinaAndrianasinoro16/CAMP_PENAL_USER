@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Materiel</h2>
            </div>
            <div class="py-3"></div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title h3">Liste materiel</div>
                            <div class="table-responsive">
                                <table id="example" class="table table-hover" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Quantité</th>
                                        <th>Durée (mois)</th>
                                        <th> -- </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($materiels as $materiel)
                                        <tr>
                                            <td>{{ $materiel->materiel }}</td>
                                            <td>{{ number_format($materiel->nombre,2,'.',',') }}</td>
                                            <td>{{ $materiel->durer }}</td>
                                            <td>
                                                <a href="{{ route('DetailsMateriel', ['id' => $materiel->id_materiel]) }}">
                                                    <button class="btn btn-primary"><i class="fas fa-eye"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        var table = new DataTable('#example', {
            language: {
                url: 'https://api.allorigins.win/raw?url=http://cdn.datatables.net/plug-ins/2.1.4/i18n/fr-FR.json',
            },
        });
       // new DataTable('#example');
    </script>
@endsection
