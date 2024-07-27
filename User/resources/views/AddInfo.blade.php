@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Camp penal</h2>
            </div>
            <div class="py-3"></div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Formulaire d'ajout de collaborateur</div>
                    @if (session('success'))
                               <div class="alert alert-success w-6">
                                   {{ session('success') }}
                               </div>
                    @endif
                    <form action="{{ route('CampCollab') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ request()->segment(2) }}" name="id">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="mySelect" class="form-control-label">Collaborateur</label>
                                    <select id="mySelect" name="colab" style="height: 100%;" class="form-control" required>
                                      @foreach( $colabs as $colab )
                                          <option value="{{ $colab->id }}">{{ $colab->nom }}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="debut" class="form-control-label">date debut de fonction</label>
                                    <input type="date" id="debut" class="form-control" name="debut" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-8">
                                    <label for="fin" class="form-control-label">date fin de fonction</label>
                                    <input type="date" id="fin" class="form-control" name="fin" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-8">
                                    <label for="details" class="form-control-label">Details</label>
                                    <textarea name="details" id="details" class="form-control" rows="3"></textarea>
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

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Formulaire d'ajout de Don</div>
                    @if (session('success2'))
                        <div class="alert alert-success w-6">
                            {{ session('success2') }}
                        </div>
                    @endif
                    <form action="{{ route('Dons') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ request()->segment(2) }}">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="mySelect2" class="form-control-label">Materiel</label>
                                    <select id="mySelect2" name="materiel" style="width: 100%;" class="form-control" required>
                                        @foreach( $materiels as $materiel )
                                            <option value="{{ $materiel->id }}">{{ $materiel->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-8">
                                    <label for="mySelect3" class="form-control-label">Donneur</label>
                                    <select id="mySelect3" name="colab" style="width: 100%;" class="form-control" required>
                                        @foreach( $colabs as $colab )
                                            <option value="{{ $colab->id }}">{{ $colab->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="Quantite" class="form-control-label">Quantite</label>
                                   <input class="form-control" id="Quantite" name="qte" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="date" class="form-control-label">Date d'envoie</label>
                                    <input class="form-control" id="date" name="date" type="date">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#mySelect, #mySelect2, #mySelect3').select2({
                placeholder: "Sélectionnez une option",
                allowClear: true
            });
        });
    </script>
@endsection
