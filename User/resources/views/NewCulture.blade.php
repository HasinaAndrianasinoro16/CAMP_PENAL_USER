@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Culture</h2>
            </div>
            <div class="py-3"></div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success w-6">
                {{ session('success') }}
            </div>
        @endif
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Ajouter culture (excel)</div>
                    <div class="py-3"></div>
                    <form action="{{ route('ImportCulture') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="col-9">
                                <label for="Nom" class="form-control-label">Veuiller selectionner le fichier excel/csv</label>
                                <input type="file" class="form-control" name="csv_file" class="form-control">
                            </div>
                        </div>
                        <div class="py-2"></div>
                        <div class="form-group">
                            <div class="col-9">
                                <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-check"></i> Enregistrer</button>
                                <a href="{{ route('ModelCulture') }}" class="btn btn-warning btn-lg"><i class="fas fa-file-excel-o"></i> Telecharger le model Excel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Ajouter Cultures</div>
                    <form action="{{ route('AjoutCulture') }}" method="post">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="Nom" class="form-control-label">Nom</label>
                                    <input type="text" id="Nom" name="name" placeholder="Entrer le nom" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="prix" class="form-control-label">Prix unitaire par Tonnes </label>
                                    <input type="text" id="prix" name="prix" placeholder="10.000.000" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-9">
                                    <label for="sol" class="form-control-label">Sol</label>
                                    <select id="sol" name="sol" class="form-control">
                                        @foreach($sols as $sol)
                                            <option value="{{ $sol->id }}">{{ $sol->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="py-2"></div>
                            <div class="form-group">
                                <div class="col-9">
                                    <button type="submit" class="btn btn-success w-25 btn-lg"><i class="fas fa-check"></i> Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
