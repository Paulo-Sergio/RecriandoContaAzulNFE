<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="<?= BASE_URL ?>/assets/css/login.css" rel="stylesheet"/>
    </head>
    <body>

        <div class="loginarea">
            <form method="POST">
                <input type="email" name="email" placeholder="Digite seu e-mail">

                <input type="password" name="password" placeholder="Digite sua senha">

                <input type="submit" value="Entrar"/>
            </form>
        </div>

        <?php if (isset($error) && !empty($error)) : ?>
            <div class="warning"><?= $error ?></div>
        <?php endif; ?>

    </body>
</html>
