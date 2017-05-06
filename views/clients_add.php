<h1>Clientes - Adicionar</h1>

<?php if (isset($error_msg) && !empty($error_msg)) : ?>
    <div class="warn"><?= $error_msg ?></div>
<?php endif; ?>
<form method="POST">

    <label for="name">Nome</label>
    <input type="text" name="name" id="name" required><br><br>
    
    <label for="email">E-mail</label>
    <input type="email" name="email" id="email"><br><br>
    
    <label for="phone">Telefone</label>
    <input type="text" name="phone" id="phone"><br><br>
    
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

    <input type="submit" value="Adicionar">
</form>