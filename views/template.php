<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel - <?= $viewData['company_name'] ?></title>
    </head>
    <body>

        <?php $this->loadViewInTemplate($viewName, $viewData) ?>
        
    </body>
</html>
