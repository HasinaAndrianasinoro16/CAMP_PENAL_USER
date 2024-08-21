@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Culture</h2>
            </div>
            <div class="py-3"></div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Modifier Cultures</div>
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
                    <form action="{{ route('ModifierCulture') }}" method="post">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="Nom" class="form-control-label">Nom</label>
                                    <input type="text" id="Nom" name="name" value="{{ $culture->nom }}" class="form-control">
                                    <input type="hidden" name="id" value="{{ $culture->id }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="prix" class="form-control-label">Prix unitaire par Tonnes </label>
                                    <input type="text" id="prix" name="prix" value="{{ $culture->prixunitaire }}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-9">
                                    <label for="sol" class="form-control-label">Sol</label>
                                    <select id="sol" name="sol" class="form-control">
                                        @foreach($sols as $sol)
                                            <option value="{{ $sol->id }}" {{ $culture->sol == $sol->id ? 'selected' : ' '}}>{{ $sol->nom }}</option>
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
