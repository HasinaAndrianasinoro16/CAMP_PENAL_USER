@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Camp penal</h2>
            </div>
            <div class="py-3"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">formulaire</div>
                    <form action="{{ route('DepenseDate') }}" method="post">
                        @csrf
                        <div class="row">
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="years" class="form-label">Annees</label>
                                    <input type="hidden" value="{{ request()->segment(2) }}" name="camp">
                                    <select class="form-control" name="year" id="years">
                                        @foreach( $years as $year )
                                            <option value="{{ $year->year }}">{{ $year->year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="years" class="form-label">Mois</label>
                                            <select class="form-control" name="month" id="month">
                                                @foreach( $months as $month )
                                                    <option value="{{ $month->month }}">{{ ucfirst(\Carbon\Carbon::create()->month($month->month)->translatedFormat('F'))}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                            <dic class="col-lg-6">
                                <button class="btn btn-success btn-lg"><i class="fas fa-check"></i> regarder </button>
                            </dic>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="statistic">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7 col-lg-4">
                        <div class="statistic__item">
                            <h2 class="number h4">{{ number_format($rendement,2,',' , '.') }} Ar</h2>
                            <span class="desc">Rendement</span>
                            <div class="icon">
                                <i class="zmdi zmdi-money"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="statistic__item">
                            <h2 class="number h4">{{ number_format($totalestimation,2,',' , '.') }} Ar</h2>
                            <span class="desc">Estimations recolte</span>
                            <div class="icon">
                                <i class="zmdi zmdi-money"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="statistic__item">
                            <h2 class="number h4">{{ number_format($totaldon,2,',' , '.') }} Ar</h2>
                            <span class="desc">Don d'argent </span>
                            <div class="icon">
                                <i class="zmdi zmdi-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h4">Detail des don d'argent</div>
                    <div class="top-campaign">
                        <div class="table-responsive">
                            <table class="table table-top-campaign">
                                <tbody>
                                @foreach( $dons as $don )
                                    <tr>
                                        <td>{{ $don->colab }}</td>
                                        <td>{{ number_format($don->quantite,2,',','.') }} Ar</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h4">Details d'estimation recolte</div>
                    <table class="table table-responsive-lg table-striped">
                        <thead class="table-dark" >
                            <th>Culture</th>
                            <th>Quantite (en Tonnes)</th>
                            <th>Estimation</th>
                            <th>Etat</th>
                        </thead>
                        <tbody>
                        @foreach( $estimations as $estimation )
                            <tr>
                                <td>{{ $estimation->nom }}</td>
                                <td>{{ $estimation->quantite }} T</td>
                                <td>{{ number_format($estimation->estimation,2,',','.') }} Ar</td>
                                @if( $estimation->etat == 0 )
                                    <td class="text-success">Entrée de stock le {{ \Carbon\Carbon::make($estimation->datestock)->format('d-m-Y') }}</td>
                                @else
                                    <td class="text-danger">Sortie de stock le {{ \Carbon\Carbon::make($estimation->datestock)->format('d-m-Y') }}</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $estimations->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
