$(document).ready(function () {

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