<h1>Clientes</h1>

<?php if ($edit_permission): ?>
    <a class="button" href="<?= BASE_URL ?>/clients/add">Adicionar Cliente</a>
<?php endif; ?>

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
                <a class="button button_small" href="<?= BASE_URL ?>/clients/edit/<?= $us['id'] ?>">Editar</a>
                <a class="button button_small" href="<?= BASE_URL ?>/clients/delete/<?= $us['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir ?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>