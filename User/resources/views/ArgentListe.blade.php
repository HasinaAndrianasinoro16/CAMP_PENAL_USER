@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Materiel</h2>
                <a href="{{ route('ArgentExport') }}">
                    <button class="au-btn au-btn-icon au-btn--green">
                        <i class="fas fa-file-excel-o"></i>Excel
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
                            <div class="card-title h3">Liste des Dons d'argent</div>
                            <table id="example" class="table table-hover" >
                                <thead>
                                <tr>
                                    <th>Materiel</th>
                                    <th>Donneur</th>
                                    <th>Camp</th>
                                    <th>quantite</th>
                                    <th>Date d'obtention</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $materiels as $materiel )
                                    <tr>
                                        <td>{{ $materiel->materiel }}</td>
                                        <td>{{ $materiel->colab }}</td>
                                        <td>{{ $materiel->camp }}</td>
                                        <td>{{ number_format($materiel->quantite,2,',','.') }} Ar</td>
                                        <td>{{ $materiel->datedon }}</td>
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
    </script>
@endsection
