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

        {{--$('.visualizar').click(function () {--}}
        {{--    $.ajax({--}}
        {{--        url: '{{route('veiculo.detalhe')}}',--}}
        {{--        type: 'POST',--}}
        {{--        data: {--}}

        {{--        },--}}
        {{--        success(result) {--}}

        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        // let $datatable_cars = $('#datatable-users');

        $('#datatable-cars').delegate('.edit', 'click', function (e) {

            e.preventDefault();

            var url = $(this).attr('href');

            $('#form-edit').prop('action', url);

            $.ajax({
                url: url,
                type: 'GET',
                success: function (result) {

                    $('#form-edit').attr('action', `{{route('veiculos.index')}}/${result.id}`)

                    var _modal = $('#edit-car-modal');

                    _modal.find('[name="modelo"]').val(result.modelo);
                    _modal.find('[name="montadora"]').val(result.montadora);
                    _modal.find('[name="ano"]').val(result.ano);
                    _modal.find('[name="placa"]').val(result.placa);
                    _modal.find('[name="categoria"]').val(result.id_categoria);
                    _modal.find('[name="categoria"]').val(result.id_categoria);
                    _modal.find('[name="diaria"]').val(result.valor_diaria);

                    // let roles = [];
                    //
                    // $(result.data.roles).each((k, v) => {
                    //     roles.push(v.id);
                    // });
                    //
                    // _modal.find('[name="roles[]"]').val(roles).change();

                    _modal.modal('show');

                },
                error: function (result) {
                    $.Notification.notify('error', 'top center', 'Error', 'Ocorreu um erro inesperado!')
                }
            });
        });

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
                    {data: 'descricao'},
                    {
                        data: 'id', "ordering": false, "render": function (data, type, row) {
                            return [
                            `<a href="detalhes-veiculo/${data}"><i class="ti-eye text-warning visualizar" data-toogle="modal" data-target="#visualizar" title="Visualizar" style="cursor: pointer;"></i></a> ` +
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
                        </td>
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

        <div id="edit-car-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"><i class="ti-car"></i> Editar Veículo</h4>
                    </div>
                    {!! Form::open(['method' => 'PUT', 'route'=>'veiculos.index','id'=>'form-edit', 'enctype' => 'multipart/form-data']) !!}
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
@endsection
