<h1>Clientes</h1>

<?php if ($edit_permission): ?>
    <a class="button" href="<?= BASE_URL ?>/clients/add">Adicionar Cliente</a>
<?php endif; ?>
<input type="text" id="busca" data-type="search_clients"/>

<table width="100%">
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Cidade</th>
        <th>Estrelas</th>
        <th width="160">Ações</th>
    </tr>
    <?php foreach ($clients_list as $c): ?>
        <tr>
            <td><?= $c['name'] ?></td>
            <td><?= $c['phone'] ?></td>
            <td><?= $c['address_city'] ?></td>
            <td><?= $c['stars'] ?></td>
            <td>
                <?php if ($edit_permission) : ?>
                    <a class="button button_small" href="<?= BASE_URL ?>/clients/edit/<?= $c['id'] ?>">Editar</a>
                    <a class="button button_small" href="<?= BASE_URL ?>/clients/delete/<?= $c['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir ?')">Excluir</a>
                <?php else : ?>
                    <a class="button button_small" href="<?= BASE_URL ?>/clients/view/<?= $c['id'] ?>">Visualizar</a>
                <?php endif; ?>

            </td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="pagination">
    <?php for ($i = 1; $i <= $p_count; $i++): ?>
        <div class="pag_item <?= ($i == $p) ? 'pag_ativo' : '' ?>"><a href="<?= BASE_URL ?>/clients?p=<?= $i ?>"><?= $i ?></a></div>
    <?php endfor; ?>
    <div style="clear: both"></div>
</div>

<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script_clients.js"></script>