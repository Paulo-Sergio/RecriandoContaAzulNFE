<div class="db-row row-one">
    <div class="grid-1">
        <div class="db-grid-area">
            <div class="db-grid-area-count"><?= $products_sold ?></div>
            <div class="db-grid-area-legend">Produtos Vendidos</div>
        </div>
    </div>

    <div class="grid-1">
        <div class="db-grid-area">
            <div class="db-grid-area-count">R$ <?= number_format($revenue, 2, ",", ".") ?></div>
            <div class="db-grid-area-legend">Receitas</div>
        </div>
    </div>

    <div class="grid-1">
        <div class="db-grid-area">
            <div class="db-grid-area-count">R$ <?= number_format($expenses, 2, ",", ".") ?></div>
            <div class="db-grid-area-legend">Despesas</div>
        </div>
    </div>
</div>

<div class="db-row row-two">
    <div class="grid-2">
        <div class="db-info">
            <div class="db-info-title">Gráfico de despesas e receitas dos ultimos 30 dias</div>
            <div class="db-info-body">
                <canvas id="rel1"></canvas>
            </div>
        </div>
    </div>

    <div class="grid-1">
        <div class="db-info">
            <div class="db-info-title">Status de Pagamento.</div>
            <div class="db-info-body">
                <canvas id="rel2"></canvas>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/Chart.min.js"></script>
<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script_home.js"></script>