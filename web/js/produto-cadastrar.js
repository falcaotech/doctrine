$('#modal').on('hidden.bs.modal', function (e) {
    $(this)
        .find("input,textarea,select")
        .val('')
        .end()
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end()
        .find(".result")
        .html('');
});

$('#btn-produto-cadastrar').click(function(e){
    e.preventDefault();

    $.ajax({
        url: '/api/produtos',
        data: $('#form-produto-cadastrar').serialize(),
        type: "POST",
        dataType: "json",
        success: function(data, status, xhr)
        {
            $('#modal').modal('hide');

            location.reload();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
            data = JSON.parse(XMLHttpRequest.responseText);

            $('.result').html("<div class='alert alert-danger'><b>Erro!</b> " + data.msg + "</div>");
        }
    })
});