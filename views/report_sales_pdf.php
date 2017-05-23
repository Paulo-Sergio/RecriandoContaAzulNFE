<style>
    th{
        text-align: left;
    }
</style>

<h1>Relatório de Vendas</h1>

<fieldset>
    <?php
    if (isset($filters['client_name']) && !empty($filters['client_name'])) {
        echo "Filtrado pelo cliente: " . $filters['client_name'] . "<br>";
    }
    if (!empty($filters['period1']) && !empty($filters['period2'])) {
        echo "No período: " . date('d/m/Y', strtotime($filters['period1'])) . " à " . date('d/m/Y', strtotime($filters['period2'])) . "<br>";
    }
    if (isset($filters['status']) && $filters['status'] != '') {
        echo "Filtrado com status: " . $statuser[$filters['status']] . "<br>";
    }
    ?>

</fieldset>

<table width="100%">
    <tr>
        <th>Nome do Cliente</th>
        <th>Data</th>
        <th>Status</th>
        <th>Valor</th>
    </tr>
    <?php foreach ($sales_list as $sale_item): ?>
        <tr>
            <td><?= $sale_item['name'] ?></td>
            <td><?= date('d/m/Y', strtotime($sale_item['date_sale'])) ?></td>
            <td><?= $statuser[$sale_item['status']] ?></td>
            <td>R$ <?= number_format($sale_item['total_price'], 2, ',', '.') ?></td>
        </tr>
    <?php endforeach; ?>
</table>