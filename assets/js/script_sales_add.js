$(document).ready(function () {

    // mascara para o price
    $('input[name=total_price]').mask('000.000.000.000.000,00',
            {reverse: true, placeholder: "0,00"});


    // adicionando o cliente para a compra via ajax
    $('.client_add_button').on('click', function (e) {
        e.preventDefault();

        var name = $('#client_name').val();
        if (name != '' && name.length > 4) {
            if (confirm('Você deseja adicionar um cliente com nome: ' + name + '?')) {
                //alert('adicionando...');
                $.ajax({
                    url: BASE_URL + '/ajax/add_client',
                    type: 'POST',
                    data: {name: name},
                    dataType: 'json',
                    success: function (json) {
                        $('.searchresults').hide();
                        $('input[name=client_id]').val(json.id);
                    }
                });
            }
        }

    });

    // implementando auto-complete do campo cliente [busca de clientes na tela sales_add]
    $('#client_name').on('keyup', function () {
        var datatype = $(this).attr('data-type');
        var queryVal = $(this).val();

        if (datatype != '') {
            $.ajax({
                url: BASE_URL + '/ajax/' + datatype,
                type: 'GET',
                data: {query: queryVal},
                dataType: 'json',
                success: function (json) {
                    //criando a div dos resultados
                    if ($('.searchresults').length == 0) {
                        $('#client_name').after('<div class="searchresults"></div>')
                    }
                    $('.searchresults').css({left: $('#client_name').offset().left + 'px'});
                    $('.searchresults').css({top: $('#client_name').offset().top + $('#client_name').height() + 5 + 'px'});

                    var html = '';

                    for (var i in json) {
                        html += '<div class="si"><a href="javascript:;" onclick="selectClient(this)" data-id="' + json[i].id + '">'
                                + json[i].name +
                                '</a></div>';
                    }

                    $('.searchresults').html(html);
                    $('.searchresults').show();
                }
            });
        }
    });


    // adicionando produto para a compra via ajax [sales_add]
    $('#add_prod').on('keyup', function () {
        var datatype = $(this).attr('data-type');
        var queryVal = $(this).val();

        if (datatype != '') {
            $.ajax({
                url: BASE_URL + '/ajax/' + datatype,
                type: 'GET',
                data: {query: queryVal},
                dataType: 'json',
                success: function (json) {
                    //criando div dos resultados
                    if ($('.searchresults').length == 0) {
                        $('#add_prod').after('<div class="searchresults"></div>');
                    }
                    $('.searchresults').css({left: $('#add_prod').offset().left + 'px'});
                    $('.searchresults').css({top: $('#add_prod').offset().top + $('#add_prod').height() + 5 + 'px'});

                    var html = '';

                    for (var i in json) {
                        html += '<div class="si"><a href="javascript:;" onclick="addProd(this)" data-id="' + json[i].id + '" data-price="' + json[i].price + '" data-name="' + json[i].name + '">'
                                + json[i].name + ' - R$ ' + json[i].price +
                                '</a></div>';
                    }

                    $('.searchresults').html(html);
                    $('.searchresults').show();
                }
            });
        }
    });
});

function selectClient(obj) {
    var id = $(obj).attr('data-id');
    var name = $(obj).html();

    $('.searchresults').hide();
    $('#client_name').val(name);
    $('input[name=client_id]').val(id);
}

function addProd(obj) {
    var id = $(obj).attr('data-id');
    var price = $(obj).attr('data-price');
    var name = $(obj).attr('data-name');

    if ($('input[name="quant[' + id + ']"]').length == 0) {
        var tr = '<tr>' +
                '<td>' + name + '</td>' +
                '<td>' +
                '<input type="number" name="quant[' + id + ']" class="p_quant" data-price="' + price + '" onchange="updateSubTotal(this)" value="1">' +
                '</td>' +
                '<td>R$ ' + price + '</td>' +
                '<td class="subtotal">R$ ' + price + '</td>' +
                '<td><a href="javascript:;" onclick="excluirProd(this)">Excluir</a></td>' +
                '</tr>';
    }

    $('.searchresults').hide();
    $('#add_prod').val('');
    $('#products_table').append(tr);

    updateTotal();
}

function updateSubTotal(obj) {
    var quant = $(obj).val();
    if (quant <= 0) {
        $(obj).val(1);
        quant = 1;
    }
    var price = $(obj).attr('data-price');
    var subtotal = quant * price;

    $(obj).closest('tr').find('.subtotal').html('R$ ' + subtotal);

    updateTotal();
}

function updateTotal() {
    var total = 0;
    for (var i = 0; i < $('.p_quant').length; i++) {
        var quant = $('.p_quant').eq(i);

        var price = quant.attr('data-price');
        var subtotal = price * parseInt(quant.val());

        total += subtotal;
    }

    $('input[name=total_price]').val('R$ ' + total);
}

function excluirProd(obj) {
    $(obj).closest('tr').remove();
    updateTotal();
}