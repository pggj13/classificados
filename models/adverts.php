<?php

class adverts extends model {

    public function get_adverts() {

        $sql = $this->db->prepare("SELECT *,(select url_imagem from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id LIMIT 1) as imagem FROM anuncios LIMIT 3");
        $sql->execute();

        $array = array();
        if ($sql->rowcount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function get_last_adverts($page, $limit, $filtros) {


        $offset = ($page - 1) * $limit;

        $filtroString = array('1=1');
        if (!empty($filtros['categorias'])) {
            $filtroString[] = 'anuncios.id_categoria  =:id_categoria';
        }
        if (!empty($filtros['preco'])) {
            $filtroString[] = 'anuncios.valor BETWEEN :preco1 AND :preco2';
        }
        if (!empty($filtros['estado'])) {

            $filtroString[] = 'anuncios.estado =:estado';
        }

        $array = array();
        $sql = $this->db->prepare("SELECT *,(SELECT anuncios_imagens.url_imagem FROM anuncios_imagens "
                . "WHERE anuncios_imagens.id_anuncio = anuncios.id limit 1) as url,"
                . "(SELECT categorias.nome_cat FROM categorias WHERE categorias.id = anuncios.id_categoria) as categoria "
                . "FROM anuncios WHERE " . implode(' AND ', $filtroString) . " ORDER BY id DESC LIMIT $offset,$limit");


        if (!empty($filtros['categorias'])) {
            $sql->bindValue(":id_categoria", $filtros['categorias']);
        }
        if (!empty($filtros['preco'])) {

            $preco = explode('-', $filtros['preco']);
            $sql->bindValue(":preco1", $preco[0]);
            $sql->bindValue(":preco2", $preco[1]);
        }
        if (!empty($filtros['estado'])) {
            $sql->bindValue(":estado", $filtros['estado']);
        }
        $sql->execute();

        if ($sql->rowcount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function count_adverts($filtros) {

        $qt = 0;

        $filtrostring = array('1=1');
        if (!empty($filtros['categorias'])) {
            $filtrostring[] = 'anuncios.id_categoria = :id_categoria';
        }
        if (!empty($filtros['preco'])) {
            $filtrostring[] = 'anuncios.valor BETWEEN :preco1 AND :preco2';
        }
        if (!empty($filtros['estado'])) {

            $filtrostring[] = 'anuncios.estado =:estado';
        }
        $sql = $this->db->prepare("SELECT COUNT(*) as qt FROM anuncios WHERE " . implode(' AND ', $filtrostring) . "");
        if (!empty($filtros['categorias'])) {
            $sql->bindValue(":id_categoria", $filtros['categorias']);
        }
        if (!empty($filtros['preco'])) {

            $preco = explode('-', $filtros['preco']);
            $sql->bindValue(":preco1", $preco[0]);
            $sql->bindValue(":preco2", $preco[1]);
        }
        if (!empty($filtros['estado'])) {
            $sql->bindValue(":estado", $filtros['estado']);
        }
        $sql->execute();

        if ($sql->rowcount() > 0) {
            $sql = $sql->fetch();
            $qt = $sql['qt'];
        }
        return $qt;
    }

    public function add_adverts($titulo, $valor, $descricao, $categoria, $fotos, $estado, $id_usuario) {
        $sql = $this->db->prepare("INSERT INTO anuncios SET titulo =:titulo,id_usuario =:id_usuario,valor =:valor,descricao =:descricao,id_categoria =:id_categoria,estado =:estado ");


        $sql->bindValue(":titulo", $titulo);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":id_categoria", $categoria);
        $sql->bindValue(":estado", $estado);
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->execute();


        $array = array();
        if ($sql->rowcount() > 0) {
            $id_anuncio = $this->db->lastInsertId();
            $this->add_photo_prod($fotos, $id_anuncio);
        }
        return true;
    }

    public function add_photo_prod($fotos, $id_anuncio) {

        if (count($fotos) > 0) {

            for ($q = 0; $q < count($fotos['tmp_name']); $q++) {
                $tipo = $fotos['type'][$q];


                if (in_array($tipo, array('image/png', 'image/jpeg', 'image/jpg'))) {

                    $md5imagem = md5(time() . rand(0, 9999)) . '.jpg';

                    move_uploaded_file($fotos['tmp_name'][$q], 'assets/images/adverts/' . $md5imagem);

                    list($width_orig, $height_orig) = getimagesize('assets/images/adverts/' . $md5imagem);
                    $ratio = ($width_orig / $height_orig);

                    $width_limit = 500;
                    $height_limit = 500;

                    if ($width_limit / $height_limit > $ratio) {
                        $width_limit = $height_limit * $ratio;
                    } else {
                        $height_limit = $width_limit / $ratio;
                    }
                    $newimagem = imagecreatetruecolor($height_limit, $width_limit);

                    if ($tipo == 'image/jpeg') {
                        $orig = imagecreatefromjpeg('assets/images/adverts/' . $md5imagem);
                    } elseif ($tipo == 'image/png') {
                        $orig = imagecreatefrompng('assets/images/adverts/' . $md5imagem);
                    }
                    imagecopyresampled($newimagem, $orig, 0, 0, 0, 0, $width_limit, $height_limit, $width_orig, $height_orig);

                    imagejpeg($newimagem, 'assets/images/adverts/' . $md5imagem, 100);

                    $sql = $this->db->prepare("INSERT INTO anuncios_imagens SET id_anuncio = :id_anuncio,url_imagem =:url_imagem");
                    $sql->bindValue(":id_anuncio", $id_anuncio);
                    $sql->bindValue(":url_imagem", $md5imagem);
                    $sql->execute();
                }
            }
        }
    }

    public function get_advert($id_usuario) {

        $sql = $this->db->prepare("SELECT * ,(select url_imagem from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id LIMIT 1) as imagem FROM anuncios WHERE id_usuario =:id_usuario ");
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->execute();

        $array = array();
        if ($sql->rowcount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getadvert($id_anuncio) {

        //var_dump($id_anuncio);
        //exit();
        $sql = $this->db->prepare("SELECT *,(select categorias.nome_cat from categorias where categorias.id = anuncios.id_categoria) as categoria,(select usuarios.telefone from usuarios where usuarios.id = anuncios.id_usuario) as telefone FROM anuncios WHERE id =:id");
        $sql->bindValue(":id", $id_anuncio);
        $sql->execute();

        $array = array();
        if ($sql->rowcount() > 0) {
            $array = $sql->fetch();
            $array['fotos'] = $this->get_fotosAdvert($id_anuncio);
        }
        return $array;
    }

    public function get_fotosAdvert($id_anuncio) {

        $sql = $this->db->prepare("SELECT id,url_imagem FROM anuncios_imagens WHERE id_anuncio =:id_anuncio");
        $sql->bindValue(":id_anuncio", $id_anuncio);
        $sql->execute();

        $array = array();
        if ($sql->rowcount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function delete_advert($id) {

        $sql = $this->db->prepare("SELECT url_imagem FROM anuncios_imagens WHERE id_anuncio =:id_anuncio");
        $sql->bindValue(":id_anuncio", $id);
        $sql->execute();

        if ($sql->rowcount() > 0) {
            $rows = $sql->fetchAll();
            foreach ($rows as $row) {
                unlink("assets/images/adverts/" . $row['url_imagem']);
            }
        }

        $sql = $this->db->prepare("DELETE FROM anuncios WHERE id =:id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        $sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id_anuncio =:id_anuncio");
        $sql->bindValue(":id_anuncio", $id);
        $sql->execute();
    }

    public function delete_photo($id) {

        $sql = $this->db->prepare("SELECT id_anuncio,url_imagem FROM anuncios_imagens WHERE id=:id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowcount() > 0) {
            $rows = $sql->fetch();
            $id_anuncio = $rows['id_anuncio'];
            unlink("assets/images/adverts/" . $rows['url_imagem']);
        }
        $sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id =:id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $id_anuncio;
    }

    public function edit_adverts($titulo, $valor, $descricao, $categoria, $estado, $id) {

        $sql = $this->db->prepare("UPDATE anuncios SET titulo =:titulo,valor =:valor,descricao =:descricao,id_categoria=:id_categoria,estado=:estado WHERE id =:id");
        $sql->bindValue(":titulo", $titulo);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":id_categoria", $categoria);
        $sql->bindValue(":estado", $estado);
        $sql->bindValue(":id", $id);
        $sql->execute();
        return true;
    }

}
