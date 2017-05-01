<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel - <?= $viewData['company_name'] ?></title>
        <link href="<?= BASE_URL ?>/assets/css/template.css" rel="stylesheet"/>
    </head>
    <body>

        <div class="leftmenu">
            <div class="company_name">
                <?= $viewData['company_name'] ?>
            </div>
        </div>
        <div class="container">
            <div class="top">
                <div class="top_right"><a href="<?= BASE_URL . "/login/logout" ?>">Sair</a></div>
                <div class="top_right"><?= $viewData['user_email'] ?></div>
            </div>
        </div>

        <?php //$this->loadViewInTemplate($viewName, $viewData) ?>

    </body>
</html>
