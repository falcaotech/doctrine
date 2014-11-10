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
                "targets": 3 ,
                "render": function(data, type, row)
                {
                    return "R$ " + data.replace(".", ",");
                }
            },
            {
                "type": "html",
                "targets": 4 ,
                "render": function(data, type, row)
                {
                    return '<a href="" class="btn btn-default" style="margin-right: 5px;"><span class="glyphicon glyphicon-edit"></span> Editar</a>' +
                        '<a href="/produto/excluir/" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Excluir</a>';
                }
            }
        ],
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