<h1>Vendas - Editar</h1>

<strong>Nome do Cliente</strong><br>
<?= $sales_info['info']['client_name'] ?><br><br>

<strong>Data da Venda</strong><br>
<?= date('d/m/Y', strtotime($sales_info['info']['date_sale'])) ?><br><br>

<strong>Total da Venda</strong><br>
R$ <?= number_format($sales_info['info']['total_price'], 2, ',', '.') ?><br><br>

<strong>Status da Venda</strong><br>
<?php if ($permission_edit): ?>
    <form method="POST">
        <select name="status">
            <?php foreach ($statuser as $key => $value) : ?>
                <option value="<?= $key ?>" <?= ($key == $sales_info['info']['status']) ? 'selected=selected' : '' ?>>
                    <?= $value ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        <input type="submit" value="Editar">
    </form>
<?php else : ?>
    <?= $statuser[$sales_info['info']['status']] ?>
<?php endif; ?>

<hr>

<table width="100%">

    <tr>
        <th>Nome do Produto</th>
        <th>Quantidade</th>
        <th>Preço Unitário</th>
        <th>Preço Total</th>
    </tr>

    <?php foreach ($sales_info['products'] as $productitem) : ?>
        <tr>
            <td><?= $productitem['name'] ?></td>
            <td><?= $productitem['quant'] ?></td>
            <td>R$ <?= number_format($productitem['sale_price'], 2, ',', '.') ?></td>
            <td>R$ <?= number_format($productitem['sale_price'] * $productitem['quant'], 2, ',', '.') ?></td>
        </tr>
    <?php endforeach; ?>

</table>