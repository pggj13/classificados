<?php

class loginController extends Controller {

    public function __construct() {
        if (isset($_SESSION['admins']) && !empty($_SESSION['admins'])) {
            header("Location:".BASE_URL.'/home');
        }
    }
    public function index() {
        $dados = array('erro'=>'');

        if (isset($_POST['email']) && !empty($_POST['email'])) {
            if (isset($_POST['email']) && !empty($_POST['email'])) {

                $email = addslashes($_POST['email']);
                $senha = md5(addslashes($_POST['senha']));

                $admins = new admins();
                if ($admins->isLogoout($email, $senha)) {
                    $_SESSION['admins'] = true;
                    header("Location:".BASE_URL.'/home');
                }else{
                    $dados['erro'] = "Senha / ou Email incorreto!";
                }
            }
        }
        $this->loadView('login', $dados);
    }

}
