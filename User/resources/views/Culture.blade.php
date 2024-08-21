@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Culture</h2>
                <a href="{{ route('NewCulture') }}">
                    <button class="au-btn au-btn-icon au-btn--green">
                        <i class="zmdi zmdi-plus"></i>Ajouter Culture
                    </button>
                </a>
            </div>

            <div class="py-3"></div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Liste cultures</div>
                    <table id="example" class="table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>prix unitaire par Tonne</th>
                            <th>Type de sol favorable</th>
                            <th> -- </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $cultures as $culture )
                            <tr>
                                <td>{{ $culture->nom }}</td>
                                <td>{{ number_format( $culture->prixunitaire,2,',','.') }} Ar</td>
                                <td>{{ $culture->sol }}</td>
                                <td>
                                    <a href="{{ route('UpdateCulture',['id' => $culture->id]) }}" class="btn btn-warning"><i class="fas fa-pencil-square-o"></i> </a>
                                    <a href="{{ route('dropCulture', ['id' => $culture->id]) }}" class="btn btn-danger"><i class="fas fa-trash"></i> </a>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');
    </script>
@endsection
