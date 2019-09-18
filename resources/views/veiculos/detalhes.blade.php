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
                                <div class="carousel-item active">
                                    <img class="d-block img-fluid" src="{{asset('storage/images/cars/1.png')}}" />
{{--                                    <div class="carousel-caption d-none d-md-block">--}}
{{--                                        <h3 class="text-white">First slide label</h3>--}}
{{--                                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block img-fluid" src="{{asset('storage/images/cars/2.png')}}" />
{{--                                    <div class="carousel-caption d-none d-md-block">--}}
{{--                                        <h3 class="text-white">Second slide label</h3>--}}
{{--                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block img-fluid" src="{{asset('storage/images/cars/3.png')}}" />
{{--                                    <div class="carousel-caption d-none d-md-block">--}}
{{--                                        <h3 class="text-white">Third slide label</h3>--}}
{{--                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>--}}
{{--                                    </div>--}}
                                </div>
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
                <h2>{{$_GET['name']}} - {{$_GET['description']}}</h2><br>
                <h3>Diária: R${{$_GET['daily']}}</h3><br>

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
