@extends('Dashboard')
@section('content')
    <style>

    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Materiel</h2>
                <a href="{{ route('MaterielExportProvinces', ['id' => implode(',', $select)]) }}" class="au-btn au-btn-icon au-btn--green">
                    <i class="fas fa-file-excel"></i>excel
                </a>
                <a href="{{ route('MaterielAllPDFProvince', ['id' => implode(',', $select)]) }}" class="au-btn au-btn-icon au-btn--green">
                    <i class="fas fa-print"></i>PDF
                </a>
            </div>
            <div class="py-3"></div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Choix par province</div>
                    <form action="{{ route('Materiel-province') }}" method="post">
                        @csrf
                        <div class="card-body card-block">
                            <div class="row">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label">Province</label>
                                    </div>
                                    <div class="col col-md-9">
                                        @foreach( $provinces as $province)
                                            <div class="form-check-inline form-check">
                                                <label for="inline-checkbox1" class="form-check-label ">
                                                    <input type="checkbox" id="inline-checkbox1" name="province[]" value="{{ $province->id }}" class="form-check-input">{{ $province->nom }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{--                                <div class="form-group">--}}
                            {{--                                    <div class="col-8">--}}
                            {{--                                        <label for="province" class="form-control-label">Province</label>--}}
                            {{--                                        <select id="province" name="province" class="form-control">--}}
                            {{--                                            @foreach($provinces as $province)--}}
                            {{--                                                <option value="{{ $province->id }}">{{ $province->nom }}</option>--}}
                            {{--                                            @endforeach--}}
                            {{--                                        </select>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            <div class="py-2"></div>
                            <div class="form-group">
                                <div class="col-11">
                                    <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-check"></i> Voir</button>
                                    <a href="{{ route('AllMateriel') }}" class="btn btn-warning btn-lg">Tout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title h3">
                                Liste de tous les Materiels des provinces :
                                {{ implode(', ', $selectedProvinceNames->toArray()) }}
                            </div>
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
                                        <td>{{ number_format($materiel->quantite,2,',','.') }}</td>
                                        <td>{{ \Carbon\Carbon::make($materiel->datedon)->format('d-m-Y') }}</td>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#province').select2({
                placeholder: "Sélectionnez une option",
                allowClear: true
            });
        });
    </script>
    <script>
        // new DataTable('#example');
        var table = new DataTable('#example', {
            language: {
                url: 'https://api.allorigins.win/raw?url=http://cdn.datatables.net/plug-ins/2.1.4/i18n/fr-FR.json',
            },
        });
    </script>

@endsection
