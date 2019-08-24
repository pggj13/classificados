<?php

class userController extends Controller {

    public function register() {

        $dados = array('aviso' => '');
        $u = new user();
        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            if (!empty($_POST['email']) && !empty($_POST['senha']) && !empty($_POST['telefone'])) {
                $nome = addslashes($_POST['nome']);
                $email = addslashes($_POST['email']);
                $senha = md5($_POST['senha']);
                $telefone = addslashes($_POST['telefone']);
                if (!$u->is_exist($email)) {
                    if ($u->register($nome, $email, $senha, $telefone)) {
                        $dados['aviso'] = "usuario cadastrado com sucesso!";
                        header("Location:" . BASE_URL . "/user/login");
                    }
                } else {
                    $dados['aviso'] = 'Usuario ja cadastrado.<a href=' . BASE_URL . '/user/login> Deseja fazer Login</a>';
                }
            } else {
                $dados['aviso'] = "Todos os campos devem ser preenchido!";
            }
        }

        $this->loadView('register', $dados);
    }
    public function login() {
        $dados = array('aviso' => '');
        $u = new user();
        if (isset($_POST['email']) && !empty($_POST['email'])) {

            $email = addslashes($_POST['email']);
            $senha = md5($_POST['senha']);

            if ($u->is_exist($email, $senha)) {

                header("Location:" . BASE_URL . "/home");
            } else {
                $dados['aviso'] = 'Usuario nao encontra-se cadastrado.<a href=' . BASE_URL . '/user/register> Deseja Cadastrar</a>';
            }
        }
        $this->loadView('login', $dados);
    }

    public function get_out() {
        unset($_SESSION['cLogin']);
        header("Location:/");
    }

}
