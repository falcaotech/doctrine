$(document).ready( function () {

    $.fn.editable.defaults.url = '/produtos/atualizar';

    $('.editable-field').editable();

    $('.editable-field-money').editable({
        type: 'text',
        name: 'valor',
        tpl: '<input type="text" id ="valor" class="mask-money form-control input-sm">'
    });

    $("#table-produtos").addClass('table table-hover');

} );