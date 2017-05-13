<h1>Estoque</h1>

<?php if ($add_permission): ?>
    <a class="button" href="<?= BASE_URL ?>/inventory/add">Adicionar Produto</a>
<?php endif; ?>
<input type="text" id="busca" data-type="search_inventory"/>

<table width="100%">
    <tr>
        <th>Nome</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Quant. Min.</th>
        <th width="160">Ações</th>
    </tr>
    <?php foreach ($inventory_list as $product): ?>
        <tr>
            <td><?= $product['name'] ?></td>
            <td>R$ <?= number_format($product['price'], 2) ?></td>
            <td><?= $product['quant'] ?></td>
            <td><?= $product['min_quant'] ?></td>
            <td></td>
        </tr>
    <?php endforeach; ?>
</table>