@extends('Dashboard')
@section('content')
    <style>

    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Materiel</h2>
                <a href="{{ route('exportMateriel',['id' => request()->segment(2)]) }}"  class="au-btn au-btn-icon au-btn--green">
                    <i class="fas fa-file-excel"></i>excel
                </a>
                <button onclick="download()" class="au-btn au-btn-icon au-btn--green">
                    <i class="fas fa-print"></i>PDF
                </button>
            </div>
            <div class="py-3"></div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title h3">Details des Materiels</div>
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
    <script src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>
    <script>
        new DataTable('#example');

        function addPdf(id) {
            var element = document.getElementById(id);
            element.style.padding = '20px';
            element.style.fontSize = "small";

            var now = new Date();
            var dateStr = now.getFullYear() + "-" +
                ("0" + (now.getMonth() + 1)).slice(-2) + "-" +
                ("0" + now.getDate()).slice(-2) + "_" +
                ("0" + now.getHours()).slice(-2) + "-" +
                ("0" + now.getMinutes()).slice(-2) + "-" +
                ("0" + now.getSeconds()).slice(-2);

            var fileName = "Details_materiel_{{ $materiel->materiel }}_" + dateStr + ".pdf";

            html2pdf().from(element).set({
                filename: fileName,
                jsPDF: {unit: 'pt', format: 'a4', orientation: 'portrait'}
            }).save();
        }

        function download() {
            var element = document.getElementById('example');
            var originalId = element.id;  // Sauvegarder l'ID original
            element.id = 'detail';  // Changer l'ID pour le PDF
            addPdf(element.id);
            element.id = originalId;  // Restaurer l'ID original après la génération du PDF
        }
    </script>

@endsection
