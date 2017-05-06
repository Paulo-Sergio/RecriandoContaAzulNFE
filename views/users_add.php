<h1>Usuários - Adicionar</h1>

<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warn"><?= $error_msg ?></div>
<?php endif; ?>
<form method="POST">

    <label for="email">E-mail</label>
    <input type="email" name="email" required><br><br>

    <label for="password">Senha</label>
    <input type="password" name="password"><br><br>

    <label for="group">Grupo de Permissão</label>
    <select name="group" id="group" required>
        <?php foreach ($group_list as $group) : ?>
            <option value="<?= $group['id'] ?>"><?= $group['name'] ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" value="Adicionar">

</form>