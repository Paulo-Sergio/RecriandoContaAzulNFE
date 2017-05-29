// grafico 1
    var rel1 = new Chart(document.getElementById("rel1"), {

        type: 'line',
        data: {
            // itens da horizontal [eixo X]
            labels: days_list,
            // itens da vertical [eixo Y]
            datasets: [{
                    label: 'Receita',
                    data: revenue_list,
                    fill: false,
                    backgroundColor: '#0000FF',
                    borderColor: '#0000FF'
                }, {
                    label: 'Despesas',
                    data: expenses_list,
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
            labels: status_name_list,
            // informacoes
            datasets: [{
                    data: status_list,
                    backgroundColor: ['#FFCE56', '#36A2ED', '#FF6384']
                }]
        }

    });
    
    