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
                            <div class="card-title h3">Details des matieres</div>
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
                                        <td>{{ $materiel->quantite }}</td>
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
        new DataTable('#example');
    </script>
@endsection
