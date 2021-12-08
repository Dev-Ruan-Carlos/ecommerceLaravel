@extends('layouts.appadmin')
@section('body')
    <section class="container">
        <div class="flex-jb flex-ae flex-w">
            <div class="flex-c mr-1">
                <h1>Clientes</h1>
                <h2>Listagem dos clientes</h2>
            </div>
            <a href="{{route('admin.cliente.indexCliente')}}" class="botao mt-1">Cadastrar cliente</a>
        </div>
        <div class="body-card mt-1">
            <section class="box-table">
                <table id="pedidosTable" class="table-hover nowrap">
                    <thead>
                        <th>Cliente</th>
                        <th>E-mail</th>
                        <th>Nível de acesso</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </section>
        </div>
    </section>
    <script>
        var 
                pedidosTable = null,
                pedidosTableParams = {
                    dom: 'rti<"flex-jc mt-1"p>',
                    scrollX:        true,
                    scrollCollapse: true,
                    fixedColumns:   {
                        leftColumns: 0,
                        rightColumns: 0,
                        bottomColums: 20
                    },
                    searching: true,
                    serverSide: false,
                    processing: false,
                    autoWidth: false,
                    bAutoWidth: true,
                    info: false,
                    responsive: false,
                    pageLength: 13, 
                    language: {
                        url: "{{ asset('assets/lang/Portuguese-Brasil.json') }}"
                    },
                    ajax: {"url" : "{{ route('admin.cliente.get') }}"},
                    columnDefs: [
                        {
                            targets: 3,
                            width: "10px",
                        },
                    ],
                    order: [1, 'asc'],
                    columns: [
                        {data: 'nome',   name: 'nome', className: 'text-c'},
                        {data: 'email',   name: 'email', className: 'text-c'},
                        {data: 'nome_acesso',     name: 'nome_acesso', className: 'text-c'},
                        {data: 'acoes',     name: 'acoes', orderable: false, searchable: false, className: 'text-c'},
                    ]
                },
                tableClientesBusca = null;

            window.addEventListener('load', function() {
                pedidosTableParams = $('#pedidosTable').DataTable(pedidosTableParams);
            })

    </script>
@endsection 