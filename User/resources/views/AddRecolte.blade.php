@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Camp penal</h2>
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
        <!-- Formulaire d'ajout de culture -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Formulaire d'ajout de culture</div>
                    @if (session('success2'))
                        <div class="alert alert-success w-6">
                            {{ session('success2') }}
                        </div>
                    @endif
                    <form action="{{ route('SaveCulture') }}" method="post">
                        <input type="hidden" value="{{ request()->segment(2) }}" name="camp">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="camp" class="form-control-label">Camp</label>
                                    <input type="text" id="camp" name="camp" value="{{ request()->segment(2) }}" disabled class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="culture" class="form-control-label">Culture</label>
                                    <select class="form-control" name="cultures" id="culture">
                                        @foreach($cults as $cult)
                                            <option value="{{ $cult->id }}"> {{ $cult->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="supperficie" class="form-control-label">Superficie (ha)</label>
                                    <input type="text" id="supperficie" name="supperficie" placeholder="10.2" class="form-control">
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
                    <table class="table table-responsive-lg table-hover">
                        <thead>
                        <th>Nom culture</th>
                        <th>Superficie</th>
                        <th> -- </th>
                        </thead>
                        <tbody>
                        @foreach($listes as $liste)
                            <tr>
                                <td>{{ $liste->culture }}</td>
                                <td>{{ $liste->superficie }} ha</td>
                                <td>
                                    <a href="{{ route('DeleteCulture', ['id' => $liste->is_campculture]) }}">
                                        <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Formulaire d'ajout de recolte -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Formulaire d'ajout de recolte</div>
                    @if (session('success'))
                        <div class="alert alert-success w-6">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('SaveRecolte') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ request()->segment(2) }}" name="camp">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="culture" class="form-control-label">Culture</label>
                                    <select class="form-control" name="culture" id="culture">
                                        @foreach($cultures as $culture)
                                            <option value="{{ $culture->id_culture }}"> {{ $culture->culture }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="quantite" class="form-control-label">Quantité (Tonnes)</label>
                                    <input type="text" id="quantite" name="quantite" placeholder="10.2" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="recolte" class="form-control-label">Date de récolte</label>
                                    <input type="date" id="recolte" name="date" class="form-control">
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
