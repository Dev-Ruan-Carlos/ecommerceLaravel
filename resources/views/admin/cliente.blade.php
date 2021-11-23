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
        <div class="body-card">
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
                    language: {
                        url: "{{ asset('assets/lang/Portuguese-Brasil.json') }}"
                    },
                    ajax: {"url" : "{{ route('admin.cliente.get') }}"},
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
                            targets: 3,
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
                        // {
                        //     targets: [2,3,4],
                        //     render: function ( data, type, row, meta ) {
                        //         return formatar(data);
                        //     }
                        // },
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
                        {data: 'nome',   name: 'nome'},
                        {data: 'email',   name: 'email', className: 'text-c'},
                        {data: 'nome_acesso',     name: 'nome_acesso', className: 'text-c'},
                        {data: 'acoes',     name: 'acoes', orderable: false, searchable: false, className: 'text-c'},
                    ]
                },
                tableClientesBusca = null;

            window.addEventListener('load', function() {
                pedidosTableParams = $('#pedidosTable').DataTable(pedidosTableParams);
                // tableClientesBusca = document.getElementById('tableClientesBusca');

                // $('input[type="search"]').focus();

                // setTimeout(() => {
                //     if (tableClientesBusca.value.length > 0)
                //         ClienteTable.search(tableClientesBusca.value).draw();
                // }, 100);
            })

    </script>
@endsection 