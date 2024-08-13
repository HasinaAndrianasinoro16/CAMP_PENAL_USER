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
{{--                    <div class="col-md-6 col-lg-3">--}}
{{--                        <div class="statistic__item">--}}
{{--                            <h2 class="number h4">{{ number_format($budget,2,',' , '.') }} Ar</h2>--}}
{{--                            <span class="desc">Total Budget</span>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="zmdi zmdi-money"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Detail en plus</div>
                    <div class="top-campaign">
{{--                        <h3 class="title-3 m-b-30">top campaigns</h3>--}}
                        <div class="table-responsive">
                            <table class="table table-top-campaign">
                                <tbody>
                                @foreach( $dons as $don )
                                    <tr>
                                        <td>{{ $don->colab }}</td>
                                        <td>{{ number_format($don->quantite,2,',','.') }} Ar</td>
                                    </tr>
                                @endforeach
                                @foreach( $estimations as $estimation )
                                    <tr>
                                        <td>{{ $estimation->culture }}</td>
                                        <td>{{ number_format($estimation->estimation_prix,2,'.',',') }} Ar</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
