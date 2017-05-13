<h1>Clientes - Editar</h1>

<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warn"><?= $error_msg ?></div>
<?php endif; ?>
<form method="POST">

    <label for="name">Nome</label>
    <input type="text" name="name" required value="<?= $client_info['name'] ?>"><br><br>

    <label for="email">E-mail</label>
    <input type="email" name="email" value="<?= $client_info['email'] ?>"><br><br>

    <label for="phone">Telefone</label>
    <input type="text" name="phone" value="<?= $client_info['phone'] ?>"><br><br>

    <label for="stars">Estrelas</label>
    <select name="stars" id="stars">
        <option value="1" <?= ($client_info['stars'] == '1') ? 'selected' : '' ?>>1 Estrela</option>
        <option value="2" <?= ($client_info['stars'] == '2') ? 'selected' : '' ?>>2 Estrela</option>
        <option value="3" <?= ($client_info['stars'] == '3') ? 'selected' : '' ?>>3 Estrela</option>
        <option value="4" <?= ($client_info['stars'] == '4') ? 'selected' : '' ?>>4 Estrela</option>
        <option value="5" <?= ($client_info['stars'] == '5') ? 'selected' : '' ?>>5 Estrela</option>
    </select><br><br>

    <label for="internal_obs">Observações Internas</label>
    <textarea name="internal_obs" id="internal_obs"><?= $client_info['internal_obs'] ?></textarea><br><br>

    <label for="address_zipcode">CEP</label>
    <input type="text" name="address_zipcode" value="<?= $client_info['address_zipcode'] ?>"><br><br>

    <label for="address">Rua</label>
    <input type="text" name="address" value="<?= $client_info['address'] ?>"><br><br>

    <label for="address_number">Número</label>
    <input type="text" name="address_number" value="<?= $client_info['address_number'] ?>"><br><br>

    <label for="address2">Complemento</label>
    <input type="text" name="address2" value="<?= $client_info['address2'] ?>"><br><br>

    <label for="address_neighb">Bairro</label>
    <input type="text" name="address_neighb" value="<?= $client_info['address_neighb'] ?>"><br><br>

    <label for="address_city">Cidade</label>
    <input type="text" name="address_city" value="<?= $client_info['address_city'] ?>"><br><br>

    <label for="address_state">Estado</label>
    <input type="text" name="address_state" value="<?= $client_info['address_state'] ?>"><br><br>

    <label for="address_country">País</label>
    <input type="text" name="address_country" value="<?= $client_info['address_country'] ?>"><br><br>

    <input type="submit" value="Atualizar">
</form>

<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/script_clients_add.js"></script>