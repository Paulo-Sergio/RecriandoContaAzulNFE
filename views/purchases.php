<h1>Compras</h1>

<a class="button" href="<?= BASE_URL ?>/sales/add">Adicionar Nova Compra</a>

<table width="100%">
    <tr>
        <th>Data</th>
        <th>Valor</th>
        <th width="75">Ações</th>
    </tr>
    <?php foreach ($purchases_list as $purchase): ?>
        <tr>
            <td><?= date('d/m/Y', strtotime($purchase['date_purchase'])) ?></td>
            <td>R$ <?= number_format($purchase['total_price'], ",", ".") ?></td>
            <td>
                <a class="button button_small" href="<?= BASE_URL ?>/purchases/edit/<?= $purchase['id'] ?>">Editar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>