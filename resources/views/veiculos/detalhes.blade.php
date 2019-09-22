@extends('layouts.default')

@include('plugins.amcharts')
@include('plugins.ammap')
@include('plugins.circliful')
@include('plugins.sparkline')
@include('plugins.notifyjs')

@push("page-js")
    <script>

        $(document).ready(function () {

        });

    </script>
@endpush

@push('page-css')
    <style>

    </style>
@endpush

@section('page-title')
    <i class="fa fa-dash"></i> Detalhe
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-12">

                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleFade" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleFade" data-slide-to="1"></li>
                                <li data-target="#carouselExampleFade" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                @php $i = 0;@endphp
                                @foreach($imagens as $imagem)
                                    @if($i == 0)
                                        <div class="carousel-item active">
                                            <img class="d-block img-fluid" src="{{asset('storage/images/cars/' . $imagem->imagem)}}" />
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <img class="d-block img-fluid" src="{{asset('storage/images/cars/' . $imagem->imagem)}}" />
                                        </div>
                                    @endif
                                    @php $i++;@endphp
{{--                                    <div class="carousel-item">--}}
{{--                                        <img class="d-block img-fluid" src="{{asset('storage/images/cars/2.png')}}" />--}}
{{--                                    </div>--}}
{{--                                    <div class="carousel-item">--}}
{{--                                        <img class="d-block img-fluid" src="{{asset('storage/images/cars/3.png')}}" />--}}
{{--                                    </div>--}}
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card-box">
                <h2>{{$veiculo->modelo}} - {{$veiculo->descricao}}</h2><br>
                <h3>Diária: R${{$veiculo->valor_diaria}}</h3><br>

                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-success" style="width: 100%;">Alugar</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-secondary">Adicionar ao carrinho</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
