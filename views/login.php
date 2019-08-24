<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="/assets/css/register.css">
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/bootstrap.min.css"/>
        <script type="text/javascript" src="/<?php echo BASE_DIR ?>/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/<?php echo BASE_DIR ?>/assets/js/jquery-3.2.1.min.js"></script>
    </head>
    <body>
        <div class="register">
            <?php if (isset($aviso) && !empty($aviso)): ?>
                <div class="alert alert-danger" id="aviso"><center><?php echo $aviso ?></center></div>
            <?php endif; ?>
            <center><h1>Fazer Login</h1></center>
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email"class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="nome"class="form-control"/>
                </div>
                <input type="submit"value="Entrar" class="btn btn-default"/>
            </form>
        </div>
    </body>
</html>
