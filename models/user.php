<?php

class user extends model {

    public function is_exist($email, $senha) {

        if (empty($senha)) {
            $sql = $this->db->prepare("SELECT *FROM usuarios WHERE email =:email");
            $sql->bindValue(":email", $email);
        } else {
            $sql = $this->db->prepare("SELECT *FROM usuarios WHERE email =:email AND senha =:senha");
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", $senha);
        }

        $sql->execute();

        if ($sql->rowcount() > 0) {
            $sql = $sql->fetch();
            $_SESSION['cLogin'] = $sql['id'];
            return true;
        } else {
            return false;
        }
    }

    public function register($nome, $email, $senha, $telefone) {

        $sql = $this->db->prepare("INSERT INTO usuarios SET nome =:nome,email =:email,senha =:senha,telefone=:telefone");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->bindValue(":telefone", $telefone);
        $sql->execute();

        if ($sql->rowcount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function count_user() {
        $sql = $this->db->prepare("SELECT COUNT(*)  as c FROM usuarios");
        $sql->execute();
        if ($sql->rowcount() > 0) {
            $sql = $sql->fetch();
            $qt = $sql['c'];
        }
        return $qt;
    }

}
