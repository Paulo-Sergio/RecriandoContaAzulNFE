<h1>Permissões</h1>

<div class="tabarea">
    <div class="tabitem activetab">Grupos de permissões</div>
    <div class="tabitem">Permissões</div>
</div>

<div class="tabcontent">
    <div class="tabbody">
        GRUPOS DE PERMISSOES
    </div>

    <div class="tabbody">
        <a class="button" href="<?= BASE_URL ?>/permissions/add">Adicionar Permissão</a>

        <table width="100%">
            <tr>
                <th>Nome da Permissão</th>
                <th width="50">Ações</th>
            </tr>
            <?php foreach ($permission_list as $p): ?>
                <tr>
                    <td><?= $p['name'] ?></td>
                    <td><a class="button button_small" href="<?= BASE_URL ?>/permissions/delete/<?= $p['id'] ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>