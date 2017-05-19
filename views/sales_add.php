<h1>Vendas - Adicionar</h1>

<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warn"><?= $error_msg ?></div>
<?php endif; ?>
<form method="POST">

    <label for="client_name">Nome</label>
    <input type="text" name="client_name" id="client_name" data-type="search_clients"><br><br>

    <input type="submit" value="Adicionar">
</form>

<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script_sales_add.js"></script>