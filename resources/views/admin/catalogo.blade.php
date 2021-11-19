@extends('layouts.appadmin')
@section('body')
    <section class="container">
        <div class="flex-jb flex-ae flex-w">
            <div class="flex-c mr-1">
                <h1>Catálogo</h1>
                <h2>Listagem dos produtos</h2>
            </div>
            <a href="{{route('admin.catalogo.indexcadastro')}}}" class="botao mt-1">Cadastrar produto</a>
        </div>
        <div class="body-card">
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
                    language: {
                        url: "{{ asset('assets/lang/Portuguese-Brasil.json') }}"
                    },
                    ajax: {"url" : "{{ route('admin.catalogo.get') }}"},
                    columnDefs: [
                        // {
                        //     targets: 0,
                        //     render: function(data) {
                        //         if(data){
                        //             return data.toUpperCase()
                        //         }else{
                        //             return data
                        //         }
                        //     }
                        // },
                        // {
                        //     targets: 1,
                        //     width: "15%",
                        // },
                        // {
                        //     targets: 2,
                        //     width: "25%",
                        // },
                        // {
                        //     targets: [3,4],
                        //     width: "15%",
                        // },
                        {
                            targets: 5,
                            width: "10px",
                        },
                        // {
                        //     targets: [1,3,4,5],
                        //     className: 'text-c pr-2',
                        // },
                        // {
                        //     targets: 1,
                        //     render: function ( data, type, row, meta ) {
                        //         cnpjcpf = data;
                        //         if (!cnpjcpf) return '';
                        //         if (cnpjcpf.length < 14){
                        //             formatado  = cnpjcpf.substr(0, 3) + '.' +
                        //             cnpjcpf.substr(3, 3) + '.' +
                        //             cnpjcpf.substr(6, 3) + '-' +
                        //             cnpjcpf.substr(9, 2);
                        //         }else{
                        //             formatado  = cnpjcpf.substr(0, 2) + '.' +
                        //             cnpjcpf.substr(2, 3) + '.' +
                        //             cnpjcpf.substr(5, 3) + '/' +
                        //             cnpjcpf.substr(8, 4) + '-' +
                        //             cnpjcpf.substr(12, 14);
                        //         }
                        //         return formatado;                
                        //     }
                        // },
                        {
                            targets: [2,3,4],
                            render: function ( data, type, row, meta ) {
                                return formatar(data);
                            }
                        },
                        // {
                        //     targets: 4,
                        //     render: function ( data, type, row, meta ) {
                        //         celular = data;
                        //         if(celular){
                        //             formatacelular = '(' + celular.substr(0, 2) + ') ' + 
                        //             celular.substr(1, 1) + ' ' +
                        //             celular.substr(2,5) + '-' + celular.substr(-4);
                        //             return formatacelular;
                        //         }else{
                        //             return celular;
                        //         }
                        //     }
                        // }
                    ],
                    order: [1, 'asc'],
                    columns: [
                        {data: 'produto',   name: 'produto'},
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
                // tableClientesBusca = document.getElementById('tableClientesBusca');

                // $('input[type="search"]').focus();

                // setTimeout(() => {
                //     if (tableClientesBusca.value.length > 0)
                //         ClienteTable.search(tableClientesBusca.value).draw();
                // }, 100);
            })

    </script>
@endsection 