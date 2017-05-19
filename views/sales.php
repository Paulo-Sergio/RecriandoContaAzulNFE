<h1>Vendas</h1>

<a class="button" href="<?= BASE_URL ?>/sales/add">Adicionar Venda</a>

<table width="100%">
    <tr>
        <th>Nome do Cliente</th>
        <th>Data</th>
        <th>Status</th>
        <th>Valor</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($sales_list as $sale_item): ?>
        <tr>
            <td><?= $sale_item['name'] ?></td>
            <td><?= date('d/m/Y', strtotime($sale_item['date_sale'])) ?></td>
            <td><?= $sale_item['status'] ?></td>
            <td>R$ <?= number_format($sale_item['total_price'], 2, ',', '.') ?></td>
            <td>
                <a class="button button_small" href="<?= BASE_URL ?>/users/edit/<?= $us['id'] ?>">Editar</a>
                <a class="button button_small" href="<?= BASE_URL ?>/users/delete/<?= $us['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir ?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>