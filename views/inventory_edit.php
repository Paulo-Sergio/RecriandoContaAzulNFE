<h1>Produtos - Editar</h1>

<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warn"><?= $error_msg ?></div>
<?php endif; ?>
<form method="POST">

    <label for="name">Nome</label>
    <input type="text" name="name" required value="<?= $inventory_info['name'] ?>"><br><br>

    <label for="price">Preço</label>
    <input type="text" name="price" required value="<?= number_format($inventory_info['price'], 2) ?>"><br><br>

    <label for="quant">Quantidade em Estoque</label>
    <input type="number" name="quant" required value="<?= $inventory_info['quant'] ?>"><br><br>

    <label for="min_quant">Quantidade Mínima em Estoque</label>
    <input type="number" name="min_quant" required value="<?= $inventory_info['min_quant'] ?>"><br><br>

    <input type="submit" value="Editar">
</form>

<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script_inventory_add.js"></script>