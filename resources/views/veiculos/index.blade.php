@extends('layouts.default')

@include('plugins.datatables.default')
@include('plugins.moment')
@include('plugins.amcharts')
@include('plugins.ammap')
@include('plugins.circliful')
@include('plugins.sparkline')
@include('plugins.notifyjs')

@push("page-js")
    <script>

        $('.visualizar').click(function () {
            $.ajax({
                url: '{{route('veiculos.get-image')}}',
                type: 'GET',
                success(result) {
                    $('#modal-imagem').empty();
                    $('#modal-imagem').append(result);
                    let modal = $('#visualizar');
                    modal.modal('show');
                }
            });
        });

        // let $datatable_cars = $('#datatable-users');

        $(document).ready(function () {

            let table = $('#datatable-cars').DataTable({
                lengthChange: false,
                language: {
                    "url": "/plugins/datatables/i18n/Portuguese-Brasil.json"
                },
                ajax: '{{route('veiculos.all')}}',
                columns: [
                    {data: 'modelo'},
                    {data: 'placa'},
                    {data: 'valor_diaria'},
                    {
                        data: 'categoria',
                        render(data, type, row) {
                            return data.name;
                        }
                    },
                    // {data: 'created_at', "render": helper.datatables.datetime_format},
                    {data: 'descricao'},
                    {
                        data: 'id', "ordering": false, "render": function (data, type, row) {
                            return [
                            `<a><i class="ti-eye text-warning visualizar" data-toogle="modal" data-target="#visualizar" title="Visualizar" style="cursor: pointer;"></i></a> ` +
                                '<a href="{{route('veiculos.index')}}/' + data + '/edit" class="mr-2 edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil text-primary"></i></a>' +
                                        '<a href="{{route('veiculos.index')}}/' + data + '" class="mr-2 delete-link" data-toggle="tooltip" title="Remover"><i class="fa fa-trash-o text-danger"></i></a>'
                            ].join(' ')
                        }
                    }
                ],
                initComplete: function (settings, json) {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });

    </script>
@endpush

@push('page-css')
    <style>

    </style>
@endpush

@section('page-title')
    Veículos <i class="ti-car"></i>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(\Session::has('error'))
                <div class="alert alert-danger">
                    {!! \Session::get('error') !!}
                </div>
            @endif
        </div>

        <div class="col-sm-12">

            <div class="card-box">
                @can('credentials.users.create')
                    {{--                        @if (\Session::has('success'))--}}
                    {{--                            <div class="alert alert-success">--}}
                    {{--                                    {!! \Session::get('success') !!}--}}
                    {{--                            </div>--}}
                    {{--                        @elseif(\Session::has('error'))--}}
                    {{--                            <div class="alert alert-danger">--}}
                    {{--                                {!! \Session::get('error') !!}--}}
                    {{--                            </div>--}}
                    {{--                        @endif--}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="m-b-30">
                                <button type="button" class="btn btn-sm btn-success waves-effect waves-light"
                                        data-toggle="modal"
                                        data-target="#user-modal">
                                    Cadastrar <i class="mdi mdi-plus-circle-outline"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endcan

                <div class="row">
                    <table class="table table-striped" id="datatable-cars">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Placa</th>
                            <th>Valor Diária</th>
                            <th>Categoria</th>
                            <th>Descrição</th>
                            <th>Opções</th>
                        </tr>
                        </thead>
                        {{--                        <tbody>--}}
                        {{--                            <tr>--}}
                        {{--                                <td>Volkswagem Jetta</td>--}}
                        {{--                                <td>ASF-6523</td>--}}
                        {{--                                <td>R$44,56</td>--}}
                        {{--                                <td>Sedan</td>--}}
                        {{--                                <td>Veículo Sedan 4 portas, 2.0</td>--}}
                        {{--                                <td><i class="ti-eye text-warning visualizar" data-toogle="modal" data-target="#visualizar" title="Visualizar" style="cursor: pointer;"></i> <i class="ti-pencil text-primary editar" title="Editar" style="cursor: pointer;"></i> <i class="ti-trash text-danger excluir" title="Excluir" style="cursor: pointer;"></i> </td>--}}
                        {{--                            </tr>--}}
                        {{--                            <tr>--}}
                        {{--                                <td>Fiat Uno</td>--}}
                        {{--                                <td>EZA-5280</td>--}}
                        {{--                                <td>R$23,56</td>--}}
                        {{--                                <td>Sedan</td>--}}
                        {{--                                <td>Veículo compacto, duas portas, 1.0</td>--}}
                        {{--                                <td><i class="ti-eye text-warning visualizar" data-toogle="modal" data-target="#visualizar" title="Visualizar" style="cursor: pointer;"></i> <i class="ti-pencil text-primary editar" title="Editar" style="cursor: pointer;"></i> <i class="ti-trash text-danger excluir" title="Excluir" style="cursor: pointer;"></i> </td>--}}
                        {{--                            </tr>--}}
                        {{--                            <tr>--}}
                        {{--                                <td>HB20</td>--}}
                        {{--                                <td>HSN-4180</td>--}}
                        {{--                                <td>R$30,87</td>--}}
                        {{--                                <td>Sedan</td>--}}
                        {{--                                <td>Veículo compacto, quatro portas, 1.6</td>--}}
                        {{--                                <td><i class="ti-eye text-warning visualizar" data-toogle="modal" data-target="#visualizar" title="Visualizar" style="cursor: pointer;"></i> <i class="ti-pencil text-primary editar" title="Editar" style="cursor: pointer;"></i> <i class="ti-trash text-danger excluir" title="Excluir" style="cursor: pointer;"></i> </td>--}}
                        {{--                            </tr>--}}
                        {{--                            <tr>--}}
                        {{--                                <td>Renault KWID</td>--}}
                        {{--                                <td>USI-2380</td>--}}
                        {{--                                <td>R$36,27</td>--}}
                        {{--                                <td>SUV</td>--}}
                        {{--                                <td>SUV compacto 4 portas 1.6</td>--}}
                        {{--                                <td><i class="ti-eye text-warning visualizar" data-toogle="modal" data-target="#visualizar" title="Visualizar" style="cursor: pointer;"></i> <i class="ti-pencil text-primary editar" title="Editar" style="cursor: pointer;"></i> <i class="ti-trash text-danger excluir" title="Excluir" style="cursor: pointer;"></i> </td>--}}
                        {{--                            </tr>--}}
                        {{--                        </tbody>--}}
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="visualizar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto do veículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-imagem">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    {{--                    <button type="button" class="btn btn-primary">Salvar mudanças</button>--}}
                </div>
            </div>
        </div>
    </div>

    <div id="user-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="ti-car"></i> Novo Veículo</h4>
                </div>
                {!! Form::open(['route'=>'veiculos.store','id'=>'form-create', 'enctype' => 'multipart/form-data']) !!}
                <div class="modal-body">

                    <div class="form-group">
                        {!! Form::text('modelo',null,['class'=>'form-control','required', 'placeholder'=>'Modelo']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('montadora',null,['class'=>'form-control','required', 'placeholder'=>'Montadora']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('ano',null,['class'=>'form-control','required', 'placeholder'=>'Ano']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('placa',null,['class'=>'form-control','required', 'placeholder'=>'Placa']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::select('categoria', $categorias->pluck('name','id'), null, ['class'=>'select2 form-control', 'required', 'data-placeholder'=>'Perfil ']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('diaria',null,['class'=>'form-control','required', 'placeholder'=>'Valor Diária']) !!}
                    </div>
                    <span>Insira até 5 imagens: </span><br><br>
                    <div class="form-group">
                        {{--                        <input type="file" class="form-control" id="example-fileinput">--}}
                        {{--                        {!! Form::file('file', null, ['class' =>'form-control', 'required']) !!}--}}
                        {!! Form::file('imagem1') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::file('imagem2') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::file('imagem3') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::file('imagem4') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::file('imagem5') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
                    <button type="submit" id="btn-sub-new-user" class="btn btn-success waves-effect waves-light">
                        Salvar
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    {{--    <div id="edit-user-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"--}}
    {{--         aria-hidden="true" style="display: none;">--}}
    {{--        <div class="modal-dialog">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>--}}
    {{--                    <h4 class="modal-title"><i class="fa fa-user-plus"></i> Editar Usuário</h4>--}}
    {{--                </div>--}}
    {{--                {!! Form::open(['route'=>'credentials.users.index','id'=>'form-edit']) !!}--}}
    {{--                <div class="modal-body">--}}

    {{--                    <div class="form-group">--}}
    {{--                        {!! Form::text('name',null,['class'=>'form-control','required', 'placeholder'=>'Nome do usuário ']) !!}--}}
    {{--                    </div>--}}
    {{--                    <div class="form-group">--}}
    {{--                        {!! Form::email('email',null,['class'=>'form-control','required', 'placeholder'=>'Email ']) !!}--}}
    {{--                    </div>--}}
    {{--                    <div class="form-group">--}}
    {{--                        {!! Form::select('roles[]', $roles->pluck('title','id'), null, ['data-tags'=>"true",'class'=>'form-control select2', 'multiple', 'required', 'data-placeholder'=>'Perfil']) !!}--}}
    {{--                    </div>--}}

    {{--                </div>--}}
    {{--                <div class="modal-footer">--}}
    {{--                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>--}}
    {{--                    <button type="submit" id="btn-sub-new-user" class="btn btn-success waves-effect waves-light">--}}
    {{--                        Salvar--}}
    {{--                    </button>--}}
    {{--                </div>--}}
    {{--                {!! Form::close() !!}--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
