$(document).ready(function () {

    /*
     * Pagina de Permissões [troca de abas]
     */
    //quando iniciar eu mostro o 1º tabbody
    $('.tabbody').eq(0).show();

    $('.tabitem').on('click', function () {

        $('.activetab').removeClass('activetab');
        $(this).addClass('activetab');

        var item = $('.activetab').index(); // 0 ou 1
        $('.tabbody').hide();
        $('.tabbody').eq(item).show();
    });

    /*
     * Campo de busca
     */
    // animação do campo de busca
    $('#busca').on('focus', function () {
        $(this).animate({
            width: '250px'
        });
    });
    $('#busca').on('blur', function () {
        if ($(this).val() == '') {
            $(this).animate({
                width: '100px'
            });
        }
        
        setTimeout(function (){
            $('.searchresults').hide();
        }, 500);
    });

    // implementando auto-complete no campo de busca [busca de cliente, na tela clients]
    $('#busca').on('keyup', function () {
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
                        $('#busca').after('<div class="searchresults"></div>')
                    }
                    $('.searchresults').css({left: $('#busca').offset().left + 'px'}); //912px
                    $('.searchresults').css({top: $('#busca').offset().top + $('#busca').height() + 3 + 'px'}); //156.81px

                    var html = '';

                    for (var i in json) {
                        html += '<div class="si"><a href="' + json[i].link + '">'
                                + json[i].name +
                                '</a></div>';
                    }

                    $('.searchresults').html(html);
                    $('.searchresults').show();
                }
            });
        }


    });

});