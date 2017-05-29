$(document).ready(function () {

// grafico 1
    var rel1 = new Chart(document.getElementById("rel1"), {

        type: 'line',
        data: {
            // itens da horizontal [eixo X]
            labels: ['10/10', '11/10', '12/10', '13/10'],
            // itens da vertical [eixo Y]
            datasets: [{
                    label: 'Receita',
                    data: [5, 6, 9, 3],
                    fill: false,
                    backgroundColor: '#0000FF',
                    borderColor: '#0000FF'
                }, {
                    label: 'Despesas',
                    data: [4, 7, 4, 8],
                    fill: false,
                    backgroundColor: '#FF0000',
                    borderColor: '#FF0000'
                }]
        }

    });
    // grafico 2
    var rel2 = new Chart(document.getElementById('rel2'), {

        type: 'pie',
        data: {
            // titulos das fatias
            labels: ['Pago', 'Cancelado', 'Aguardando Pgto.'],
            // informacoes
            datasets: [{
                    data: [7, 2, 4],
                    backgroundColor: ['#36A2ED', '#FF6384', '#FFCE56']
                }]
        }


    });
});
