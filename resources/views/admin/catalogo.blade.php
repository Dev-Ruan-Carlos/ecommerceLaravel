@extends('layouts.appadmin')
@section('body')
    <section class="container">
        <div class="flex-jb flex-ae flex-w">
            <div class="flex-c mr-1">
                <h1>Catálogo</h1>
                <h2>Listagem dos produtos</h2>
            </div>
            <a href="{{route('admin.catalogo.indexcadastro')}}" class="botao mt-1">Cadastrar produto</a>
        </div>
        <div class="body-card mt-1">
            <section class="box-table">
                <table id="catalogoTable" class="table-hover nowrap">
                    <thead>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço de custo</th>
                        <th>Preço de venda</th>
                        <th>Preço de promoção</th>
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
                catalogoTable = null,
                catalogoTableParams = {
                    dom: 'rti<"flex-jc mt-1"p>',
                    scrollX:        true,
                    scrollCollapse: true,
                    fixedColumns:   {
                        leftColumns: 0,
                        rightColumns: 1
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
                    ajax: {"url" : "{{ route('admin.catalogo.get') }}"},
                    columnDefs: [
                        {
                            targets: 5,
                            width: "10px",
                        },
                        {
                            targets: [2,3,4],
                            render: function ( data, type, row, meta ) {
                                return formatar(data);
                            }
                        },
                    ],
                    order: [1, 'asc'],
                    columns: [
                        {data: 'produto',   name: 'produto', className: 'text-c'},
                        {data: 'quantidade',   name: 'quantidade', className: 'text-c'},
                        {data: 'precocusto',     name: 'precocusto', className: 'text-c'},
                        {data: 'precovenda',  name: 'precovenda', className: 'text-c'},
                        {data: 'precopromocao',   name: 'precopromocao', className: 'text-c'},
                        {data: 'acoes',     name: 'acoes', orderable: false, searchable: false, className: 'text-c'},
                    ]
                },
                tableClientesBusca = null;

            window.addEventListener('load', function() {
                catalogoTable = $('#catalogoTable').DataTable(catalogoTableParams);
            })

    </script>
@endsection 