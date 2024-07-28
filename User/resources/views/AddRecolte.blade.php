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
                    <div class="card-title h3">Formulaire d'ajout de recolte</div>
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
                    <form action="{{ route('SaveRecolte') }}" method="post">
                        <input type="hidden" value="{{ request()->segment(2) }}" name="camp">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="culture" class="form-control-label">Culure</label>
                                    <select class="form-control" name="culture" id="culture">
                                        @foreach( $cultures as $culture )
                                            <option value="{{ $culture->id_culture }}"> {{ $culture->culture }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="quantite" class="form-control-label">Quantite (poids)</label>
                                    <input type="text"id="quantite" name="quantite" placeholder="(10.2)" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="recolte" class="form-control-label">Date de recolte</label>
                                    <input type="date"id="recolte" name="date" class="form-control">
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
