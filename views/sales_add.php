<h1>Vendas - Adicionar</h1>

<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warn"><?= $error_msg ?></div>
<?php endif; ?>
<form method="POST">

    <label for="client_name" style="display: block">Nome do Cliente</label>
    <input type="hidden" name="client_id">
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
    <input type="text" name="total_price" disabled="disabled"><br><br>

    <hr>

    <h4>Produtos</h4>

    <fieldset>
        <legend>Adicionar Produto(s)</legend>
        <input type="text" id="add_prod" data-type="search_products">
    </fieldset>
    
    <table id="products_table" width="100%">
        <th>Nome</th>
        <th>Quant.</th>
        <th>Preço Unit.</th>
        <th>Sub-Total</th>
        <th>Excluir</th>
    </table>

    <hr>

    <input type="submit" value="Adicionar Venda">
</form>

<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script_sales_add.js"></script>