<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="/assets/css/template.css">
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/bootstrap.min.css"/>
        

    </head>
    <body id="body_site">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="/" class="navbar-brand">Classificados</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])): ?>
                        <li><a href="<?php echo BASE_URL?>/my_adverts">Meus Anúncios</a></li>
                        <li><a href="<?php echo BASE_URL?>/user/get_out">Sair</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo BASE_URL?>/user/register">Cadastre-se</a></li>
                        <li><a href="<?php echo BASE_URL?>/user/login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            
            
            <?php $this->loadViewInTemplate($viewName, $viewData); ?>
        </div>
        <script type="text/javascript" src="<?php echo BASE_URL?>/assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL?>/assets/js/scripts.js"></script>
    </body>
</html>
