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

});