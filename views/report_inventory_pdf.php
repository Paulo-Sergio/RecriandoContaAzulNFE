<style>
    th{
        text-align: left;
    }
</style>

<h1>Relatório de Estoque</h1>

<fieldset>
    Itens com estoque abaixo do mínimo!
</fieldset>
<br>

<table width="100%">
    <tr>
        <th>Nome</th>
        <th>Preço</th>
        <th>Quant.</th>
        <th>Quant. Min.</th>
        <th>Diferença</th>
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
                <?= $product['dif'] ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>