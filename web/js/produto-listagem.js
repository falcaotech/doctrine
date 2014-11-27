$(document).ready( function () {
    $('#table-produtos').DataTable({
        ajax: {
            "url": "/produtos/listagem",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id" },
            { "data": "nome" },
            { "data": "descricao" },
            { "data": "valor" },
            { "data": "" }
        ],
        "columnDefs": [
            {
                "type": "html",
                "targets": 1,
                "render": function(data, type, row) {
                    return '<a href="#" class="editable-field" id="nome" data-type="text" data-pk="' + row.id + '" data-title="Nome">' + row.nome + '</a>';
                }
            },
            {
                "type": "html",
                "targets": 2,
                "render": function(data, type, row) {
                    return '<a href="#" class="editable-field" id="descricao" data-type="textarea" data-pk="' + row.id + '" data-title="Descrição">' + row.descricao + '</a>';
                }
            },
            {
                "type": "html",
                "targets": 3 ,
                "render": function(data, type, row)
                {
                    return 'R$ <a href="#" class="editable-field-money mask-money" id="valor" data-type="text" data-pk="' + row.id + '" data-title="Valor">' + row.valor.replace(".", ",") + '</a>';
                }
            },
            {
                "type": "html",
                "targets": 4 ,
                "render": function(data, type, row)
                {
                    return '<a href="/produtos/excluir/' + row.id + '" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Excluir</a>';
                }
            }
        ],
        "fnDrawCallback": function()
        {
            $.fn.editable.defaults.url = '/produtos/atualizar';

            $('.editable-field').editable();

            $('.editable-field-money').editable({
                type: 'text',
                name: 'valor',
                tpl: '<input type="text" id ="valor" class="mask-money form-control input-sm">'
            });
        },
        language : {
            sEmptyTable: "Nenhum registro encontrado",
            sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
            sInfoFiltered: "(Filtrados de _MAX_ registros)",
            sInfoPostFix: "",
            sInfoThousands: ".",
            sLengthMenu: "_MENU_ resultados por página",
            sLoadingRecords: "Carregando...",
            sProcessing: "Processando...",
            sZeroRecords: "Nenhum registro encontrado",
            sSearch: "Pesquisar",
            oPaginate: {
                sNext: "Próximo",
                sPrevious: "Anterior",
                sFirst: "Primeiro",
                sLast: "Último"
            },
            oAria: {
                sSortAscending: ": Ordenar colunas de forma ascendente",
                sSortDescending: ": Ordenar colunas de forma descendente"
            }
        }
    });

    $("#table-produtos").addClass('table table-hover');
} );