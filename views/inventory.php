<h1>Estoque</h1>

<?php if ($add_permission): ?>
    <a class="button" href="<?= BASE_URL ?>/inventory/add">Adicionar Produto</a>
<?php endif; ?>
<input type="text" id="busca" data-type="search_inventory"/>

<table width="100%">
    <tr>
        <th>Nome</th>
        <th>Preço</th>
        <th width="60">Quant.</th>
        <th width="75">Quant. Min.</th>
        <th width="160">Ações</th>
    </tr>
    <?php foreach ($inventory_list as $product): ?>
        <tr>
            <td><?= $product['name'] ?></td>
            <td>R$ <?= number_format($product['price'], 2, ',', '.') ?></td>
            <td><?= $product['quant'] ?></td>
            <td>
                <?php if ($product['quant'] < $product['min_quant']) { ?>
                    <span style="color: red; font-weight: bolder"><?= $product['min_quant'] ?></span>
                <?php } else { ?>
                    <?= $product['min_quant'] ?>
                <?php } ?>
            </td>
            <td>
                <a class="button button_small" href="<?= BASE_URL ?>/inventory/edit/<?= $product['id'] ?>">Editar</a>
                <a class="button button_small" href="<?= BASE_URL ?>/inventory/delete/<?= $product['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir ?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script_inventory.js"></script>