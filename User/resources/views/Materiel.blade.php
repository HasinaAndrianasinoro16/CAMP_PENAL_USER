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
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Formulaire d'ajout de collaborateur</div>
                    <form action="{{ route('SaveMateriel') }}" method="post">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="Nom" class="form-control-label">Nom<span style="color: #ff0909">*</span> </label>
                                    <input type="text" id="Nom" name="nom" placeholder="Entrer le nom" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="Durer" class="form-control-label">Duree (en mois)</label>
                                    <input type="number" min="1" id="Durer" name="durer" placeholder="Entrer le nom" class="form-control">
                                </div>
                            </div>
                            <div class="py-2"></div>
                            <div class="form-group">
                                <div class="col-11">
                                    <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-check"></i> Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
