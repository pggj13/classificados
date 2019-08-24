<?php

class my_advertsController extends Controller {

    public function index() {
        $dados = array('aviso' => '');
        $adverts = new adverts();
        $dados['advert'] = $adverts->get_advert($_SESSION['cLogin']);
        $this->loadTemplate('my_adverts', $dados);
    }

    public function add_adverts() {
        $dados = array('aviso' => '');
        $adverts = new adverts();
        $category = new category();
        $dados['category'] = $category->get_category();

        if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
            $titulo = addslashes($_POST['titulo']);
            $valor = addslashes($_POST['valor']);
            $descricao = addslashes($_POST['descricao']);
            $categoria = $_POST['categoria'];

            if (isset($_FILES['imagem'])) {
                $imagem = $_FILES['imagem'];
            } else {
                $imagem = array();
            }
            if (isset($_POST['estado'])) {
                $estado = $_POST['estado'];
            } else {
                $estado = '';
            }

            if (!empty($valor) && !empty($descricao) && !empty($categoria) && !empty($categoria)) {

                if (!empty($imagem['name'][0]) && !empty($imagem['tmp_name'][0])) {
                    if ($adverts->add_adverts($titulo, $valor, $descricao, $categoria, $imagem, $estado, $_SESSION['cLogin'])) {
                        header("Location:" . BASE_URL . '/my_adverts');
                    }
                } else {
                    $dados['aviso'] = "Para fazer anuncio deve ser adicionado pelo meno uma imagem :)";
                }
            } else {
                $dados['aviso'] = "Todos os campos devem ser preenchido :)";
            }
        }
        $this->loadTemplate('add_adverts', $dados);
    }

    public function delete($id) {
        $id = addslashes($id);
        $advert = new adverts();
        if (!empty($id)) {
            $advert->delete_advert($id);
            header("Location:" . BASE_URL . '/my_adverts');
        }
    }

    public function update($id_anuncio) {
        $id = addslashes($id_anuncio);
        $dados = array('aviso' => '');
        if (!empty($id)) {
            $adverts = new adverts();
            $category = new category();
            $dados['advert'] = $adverts->getadvert($id);
            $dados['category'] = $category->get_category();


            if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {

                $titulo = addslashes($_POST['titulo']);
                $valor = addslashes($_POST['valor']);
                $descricao = addslashes($_POST['descricao']);
                $categoria = $_POST['categoria'];



                if (isset($_FILES['imagem'])) {
                    $imagem = $_FILES['imagem'];
                } else {
                    $imagem = array();
                }
                if (isset($_POST['estado'])) {
                    $estado = $_POST['estado'];
                } else {
                    $estado = '';
                }
                if (!empty($imagem['name'][0]) && !empty($imagem['tmp_name'][0])) {
                    $adverts->add_photo_prod($imagem, $id);
                }
                if (!empty($valor) && !empty($descricao) && !empty($categoria) && !empty($estado)) {

                    if ($adverts->edit_adverts($titulo, $valor, $descricao, $categoria, $estado, $id)) {
                        header("Location:" . BASE_URL . '/my_adverts');
                    }
                } else {
                    $dados['aviso'] = "Todos os campos devem ser preenchido :)";
                }
            }
            $this->loadTemplate('edit_adverts', $dados);
        }
    }

    public function delete_photo($id) {
        $advert = new adverts();
        $id = $advert->delete_photo($id);
        header("Location:" . BASE_URL . '/my_adverts/update/' . $id);
    }

    public function products($id_anuncio) {
        $dados = array();
        $adverts = new adverts();
        $dados['advert'] = $adverts->getadvert($id_anuncio);
        $this->loadTemplate('products', $dados);
    }

}
