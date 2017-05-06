<h1>Permissões - Editar Grupo de Permissões</h1>

<form method="POST">

    <label for="name">Nome do grupo permissão</label>
    <input type="text" name="name" value="<?= $group_info['name'] ?>"><br><br>

    <label>Permissões</label><br>
    <?php foreach ($permissions_list as $p): ?>
        <div class="p_item">
            <input type="checkbox" name="permissions[]" value="<?= $p['id'] ?>" id="p_<?= $p['id'] ?>"
                   <?= (in_array($p['id'], $group_info['params'])) ? 'checked="checked"' : '' ?>/>
            <label for="p_<?= $p['id'] ?>"><?= $p['name'] ?></label>
        </div>
    <?php endforeach; ?>
    <br><br>

    <input type="submit" value="Editar">

</form>