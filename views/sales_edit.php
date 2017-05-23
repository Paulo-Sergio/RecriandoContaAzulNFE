<h1>Vendas - Editar</h1>

<strong>Nome do Cliente</strong><br>
<?= $sales_info['info']['client_name'] ?><br><br>

<strong>Data da Venda</strong><br>
<?= date('d/m/Y', strtotime($sales_info['info']['date_sale'])) ?><br><br>

<strong>Total da Venda</strong><br>
R$ <?= number_format($sales_info['info']['total_price'], 2, ',', '.') ?><br><br>

<strong>Status da Venda</strong><br>
<?= $sales_info['info']['client_name'] ?><br><br>

<hr>