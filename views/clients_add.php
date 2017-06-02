<h1>Clientes - Adicionar</h1>

<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warn"><?= $error_msg ?></div>
<?php endif; ?>
<form method="POST">

    <label for="name">Nome</label>
    <input type="text" name="name" required><br><br>

    <label for="email">E-mail</label>
    <input type="email" name="email"><br><br>

    <label for="phone">Telefone</label>
    <input type="text" name="phone"><br><br>

    <label for="stars">Estrelas</label>
    <select name="stars" id="stars">
        <option value="1">1 Estrela</option>
        <option value="2">2 Estrela</option>
        <option value="3" selected="selected">3 Estrela</option>
        <option value="4">4 Estrela</option>
        <option value="5">5 Estrela</option>
    </select><br><br>

    <label for="internal_obs">Observações Internas</label>
    <textarea name="internal_obs" id="internal_obs"></textarea><br><br>

    <label for="address_zipcode">CEP</label>
    <input type="text" name="address_zipcode"><br><br>

    <label for="address">Rua</label>
    <input type="text" name="address"><br><br>

    <label for="address_number">Número</label>
    <input type="text" name="address_number"><br><br>

    <label for="address2">Complemento</label>
    <input type="text" name="address2"><br><br>

    <label for="address_neighb">Bairro</label>
    <input type="text" name="address_neighb"><br><br>

    <label for="address_state">Estado</label>
    <select name="address_state" onchange="changeState(this)">
        <?php foreach ($states as $state) : ?>
            <option value="<?= $state['Uf'] ?>"><?= $state['Uf'] ?></option>
        <?php endforeach; ?>
    </select>

    <label for="address_city">Cidade</label>
    <select name="address_city">
    </select>

    <label for="address_country">País</label>
    <input type="text" name="address_country"><br><br>

    <input type="submit" value="Adicionar">
</form>

<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script_clients_add.js"></script>