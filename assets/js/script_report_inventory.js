function openPopup(obj) {

    // serialize() -> propriedade=valor&propriedade2=valor2
    var data = $(obj).serialize();
    var url = BASE_URL + "/report/inventory_pdf?" + data;

    window.open(url, "report", "width=700,height=500");

    return false;
}

$(document).ready(function () {

});