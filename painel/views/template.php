<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="/<?php echo BASE_DIR; ?>/assets/css/template.css">
        <script type="text/javascript" src="/assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="/assets/js/scripts.js"></script>
        <link rel="stylesheet" href="/<?php echo BASE_DIR; ?>/assets/js/bootstrap.min.css">
        <script type="text/javascript" src="/<?php echo BASE_DIR; ?>/assets/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php $this->loadViewInTemplate($viewName, $viewData); ?>
    </body>
</html>
