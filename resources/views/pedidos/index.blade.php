@extends('layouts.default')

@include('plugins.datatables.default')
@include('plugins.switchery')
@include('plugins.moment')
@include('plugins.amcharts')
@include('plugins.ammap')
@include('plugins.circliful')
@include('plugins.sparkline')
@include('plugins.notifyjs')

@push("page-js")

    <script>

        let table = $('#datatable-pedidos').DataTable({
            order: [[ 0, "desc" ]],
            lengthChange: false,
            language: {
                "url": "/plugins/datatables/i18n/Portuguese-Brasil.json"
            },
            ajax: '{{route('pedidos.all')}}',
            columns: [
                {data: 'data_inicio', "render": helper.datatables.datetime_format},
                {data: 'numero_locacao'},
                {data: 'valor'},
                {data: 'status_pedido', render: function(data, type, row) {
                        return data.status;
                    }
                },
                {
                    data: 'status_pedido', "ordering": false, "render": function (data, type, row) {
                        return [
                            `<a href="pedidos/status"><i class="ti-plus text-warning view" data-toogle="modal" data-idlocacao="${row.id}"  data-id="${data.id}" data-target="#visualizar" title="Visualizar" style="cursor: pointer;"></i></a> `
                            {{--'<a href="{{route('pedidos.index')}}/' + data + '/edit" class="mr-2 edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil text-primary"></i></a>'--}}
                        ].join(' ')
                    }
                }
            ],
            initComplete: function (settings, json) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });

        $(document).ready(function () {

            $.ajax({
                url: "{{route('pedidos.all')}}",
                type: 'GET',
                success(result) {

                },
                error() {

                }
            });

            $("#status").change(function() {
                if($(this).prop('checked')) {
                    alert('opa');
                }
            });

        });

        $('#datatable-pedidos').delegate('.view', 'click', function (e) {

            e.preventDefault();

            let _modal = $('#details-modal');

            let idlocacao =  $(this).data('idlocacao');


            $.ajax({
                url: '{{route('pedidos.get-status')}}',
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    id: $(this).data('id')
                },
                success(result) {
                    $('.modal-body').append(result);
                    localStorage.setItem('idlocacao', idlocacao);
                    // $('.radio').data('idlocacao', $(this).data('idlocacao'));
                    _modal.modal('show');
                }
            });
        });

        $('#btn-sub-details').click(function() {

            $.ajax({
                url: '{{route('pedidos.save-status')}}',
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    id: $('input[name="radio"]:checked').val(),
                    idlocacao: localStorage.getItem('idlocacao')
                },
                success(result) {
                    localStorage.clear();
                    $('#details-modal').modal('hide');
                    table.ajax.reload();
                    $.Notification.notify('success', 'top right', 'Operação Realizada', 'Status atualizado com sucesso!');
                }
            });
        });

        $('#details-modal').on('hidden.bs.modal', function() {
            $('.modal-body').empty();
        });

    </script>
@endpush

@push('page-css')

    <style>

    </style>
@endpush

@section('page-title')
    Pedidos <i class="mdi mdi-truck-delivery"></i>
@endsection

@section('content')
    <div class="row">

        <div class="col-sm-12">

            <div class="card-box">

                <div class="row">
                    <table class="table table-striped" id="datatable-pedidos">
                        <thead>
                        <tr>
                            <th>Data Aluguel</th>
                            <th>Número do Pedido</th>
                            <th>Valor Aluguel</th>
                            <th>Status Aluguel</th>
                            <th>Opções</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

     <div id="details-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Editar Status</h4>
                </div>

                <div class="modal-body">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
                    <button type="button" id="btn-sub-details" class="btn btn-success waves-effect waves-light">
                        Salvar
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection
