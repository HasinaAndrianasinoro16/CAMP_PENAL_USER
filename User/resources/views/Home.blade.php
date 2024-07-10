<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <title>Projet E-Tsabo</title>
</head>
<body>
    @include('dashboard');
    {{-- id="myDataTable" a utiliser sur le datatable --}}
<body class="bg-dark" >
    <div class="container-fluid">
            <div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-5">
          <img src="{{ asset('assets/img/doc2.jpg') }}"  class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" loading="lazy" width="700" height="500">
      </div>
      <div class="col-lg-6 text-light">
        <h1 class="display-5 fw-bold lh-1 mb-3">E-Tsabo</h1>
        <p class="lead">Projet en vue d'un entrainement pour un stage et une soutenance. ce projet est un projet de gestion d'une hopital passer par les besoin d'une hopital jusq'au ressource Humaine</p>
        {{-- <p class="lead"></p> --}}
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            {{-- <a href="creationSac.jsp"><button type="button" class="btn btn-warning btn-lg px-4 me-md-2">Enjoy the process >></button></a> --}}
        </div>
      </div>
    </div>
        </div>
    </div>
</body>
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
{{-- <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script> --}}
<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable();
    });
</script>
</html>