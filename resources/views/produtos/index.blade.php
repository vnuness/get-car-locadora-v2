@extends('layouts.default')

@include('plugins.amcharts')
@include('plugins.ammap')
@include('plugins.circliful')
@include('plugins.sparkline')
@include('plugins.notifyjs')

@push("page-js")
<script>

    $('.visualizar').click(function() {
        let modal = $('#visualizar');
        modal.modal('show');
    });

    $(document).ready(function () {

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

        <div class="col-sm-12">

            <div class="card-box">
                @can('credentials.users.create')
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
                    <table class="table table-striped" id="datatable-users">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Placa</th>
                            <th>Valor Diária</th>
                            <th>Categoria</th>
                            <th>Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Volkswagem Jetta</td>
                                <td>ASF-6523</td>
                                <td>R$44,56</td>
                                <td>Sedan</td>
                                <td><i class="ti-eye text-warning visualizar" data-toogle="modal" data-target="#visualizar" title="Visualizar" style="cursor: pointer;"></i> <i class="ti-pencil text-primary editar" title="Editar" style="cursor: pointer;"></i> <i class="ti-trash text-danger excluir" title="Excluir" style="cursor: pointer;"></i> </td>
                            </tr>
                        </tbody>
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
                <div class="modal-body">
                    <center>
                        <img src="images/cars/jetta.jpg" alt="200" width="300" height="200">
                    </center>
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
                {!! Form::open(['route'=>'credentials.users.store','id'=>'form-create']) !!}
                <div class="modal-body">

                    <div class="form-group">
                        {!! Form::text('name',null,['class'=>'form-control','required', 'placeholder'=>'Modelo']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('name',null,['class'=>'form-control','required', 'placeholder'=>'Montadora']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('name',null,['class'=>'form-control','required', 'placeholder'=>'Ano']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('placa',null,['class'=>'form-control','required', 'placeholder'=>'Placa']) !!}
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" id="example-fileinput">
                    </div>
                    <div class="form-group">
                        {!! Form::select('roles[]', $categorias->pluck('name','id'), null, ['class'=>'select2 form-control', 'required', 'data-placeholder'=>'Perfil ']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('diaria',null,['class'=>'form-control','required', 'placeholder'=>'Valor Diária']) !!}
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <input type="checkbox" name="notify" checked data-size="small" data-plugin="switchery"--}}
{{--                               data-color="#00b19d"/>--}}
{{--                        Notificar usuário--}}
{{--                    </div>--}}
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

    <div id="edit-user-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="fa fa-user-plus"></i> Editar Usuário</h4>
                </div>
                {!! Form::open(['route'=>'credentials.users.index','id'=>'form-edit']) !!}
                <div class="modal-body">

                    <div class="form-group">
                        {!! Form::text('name',null,['class'=>'form-control','required', 'placeholder'=>'Nome do usuário ']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::email('email',null,['class'=>'form-control','required', 'placeholder'=>'Email ']) !!}
                    </div>
                    <div class="form-group">
{{--                        {!! Form::select('roles[]', $roles->pluck('title','id'), null, ['data-tags'=>"true",'class'=>'form-control select2', 'multiple', 'required', 'data-placeholder'=>'Perfil']) !!}--}}
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
