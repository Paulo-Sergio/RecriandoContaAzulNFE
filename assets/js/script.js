$(document).ready(function () {
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