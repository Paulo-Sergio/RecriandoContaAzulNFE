$(document).ready(function () {

    // ao sair do campo CEP
    $('input[name=address_zipcode]').on('blur', function () {

        var cep = $(this).val();

        $.ajax({
            url: 'http://api.postmon.com.br/v1/cep/' + cep,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (typeof data.logradouro != 'undefined') {
                    $('input[name=address]').val(data.logradouro);
                    $('input[name=address_neighb]').val(data.bairro);
                    $('input[name=address_city]').val(data.cidade);
                    $('input[name=address_state]').val(data.estado);
                    $('input[name=address_country]').val("Brasil");
                    
                    $('input[name=address_number]').focus();
                }
            }
        });
    });

})