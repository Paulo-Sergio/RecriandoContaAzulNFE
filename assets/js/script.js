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

});