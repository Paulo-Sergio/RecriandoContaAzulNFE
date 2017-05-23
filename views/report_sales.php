<h1>Relatórios de Vendas</h1>

<form onsubmit="return openPopup(this)">

    <div class="report-grid-4">
        Nome do Cliente:<br>
        <input type="text" name="client_name">
    </div>

    <div class="report-grid-4">
        Período:<br>
        <input type="date" name="period1"><br>
        até<br>
        <input type="date" name="period2"><br>
    </div>

    <div class="report-grid-4">
        Status da Venda:<br>
        <select name="status">
            <option value="">Todos os status</option>
            <?php foreach ($statuser as $key => $value) : ?>
                <option value="<?= $key ?>"><?= $value ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="report-grid-4">
        Ordenação:<br>
        <select name="order">
            <option value="date_desc">Mais Recentes</option>
            <option value="date_asc">Mais Antigos</option>
            <option value="status">Status da Venda</option>
        </select>
    </div>

    <div style="clear: both"></div>

    <div style="text-align: center">
        <input type="submit" value="Gerar Relatório">
    </div>

</form>

<script type="text/javascript" src="<?=BASE_URL?>/assets/js/report_sales.js"></script>