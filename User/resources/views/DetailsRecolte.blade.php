@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Recolte</h2>
            </div>
            <div class="py-3"></div>
        </div>

        <div class="col-lg-12">
            <div class="top-campaign">
                <h3 class="title-3 m-b-30">Details des recoltes {{ $camp }}</h3>
                <div class="p">
                    voici l'estimation des recoltes prochaine de ce camp :
                    @foreach( $estimations as $estimation )
                        <span class="text-success">{{ $estimation->culture }}</span> <code>{{ number_format($estimation->moyenne_quantite,2,',','.') }} Tonnes</code>,
                    @endforeach
                </div>
                <div class="py-3"></div>
                <div class="table-responsive">
                    <table class="table table-top-campaign">
                        <tbody>
                       @foreach( $recoltes as $recolte)
                           <tr>
                               <td class="h3" >{{ $recolte->culture }}</td>
                               <td class="h3">{{ number_format($recolte->quantite,2,',' , '.') }} Tonnes</td>
                           </tr>
                       @endforeach
                        </tbody>
                    </table>
                    <table class="table table-top-campaign">
                        <tbody>
                        @foreach( $recoltes as $recolte)
                            <tr>
                                <td class="h3" >Nombre de prisonnier</td>
                                <td class="h3">{{ number_format($recolte->prisonnier,1,',' , '.') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
