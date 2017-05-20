<h1>Vendas - Adicionar</h1>

<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warn"><?= $error_msg ?></div>
<?php endif; ?>
<form method="POST">

    <label for="client_name" style="display: block">Nome do Cliente</label>
    <input type="text" name="client_name" id="client_name" data-type="search_clients" autocomplete="off">
    <button class="client_add_button">+</button>
    <br><br>
    
    <label for="status">Status da Venda</label>
    <select name="status" id="status">
        <option value="0">Aguardando Pagamento</option>
        <option value="1">Pago</option>
        <option value="2">Cancelado</option>
    </select><br><br>
    
    <label for="total_price">Preço da Venda</label>
    <input type="text" name="total_price"><br><br>

    <input type="submit" value="Adicionar Venda">
</form>

<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script_sales_add.js"></script>