<?php

class homeController extends Controller {

    public function index() {
        $dados = array();

        $filtros = '';
        $filtros = array(
            'categorias' => '',
            'preco' => '',
            'estado' => ''
        );
        $adverts = new adverts();
        $user = new user();
        $category = new category();

        $limit = 3;
        $p = 1;
        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $p = $_GET['p'];
        }
        if (isset($_GET['filtros']) && !empty($_GET['filtros'])) {
            $filtros = $_GET['filtros'];
        }
        $dados['filtros'] = $filtros;
        $dados['p'] = $p;
        $dados['category'] = $category->get_category();
        $dados['count_adverts'] = $adverts->count_adverts($filtros);
        $dados['total_adverts'] = ceil($dados['count_adverts'] / $limit);
        $dados['count_user'] = $user->count_user();
        $dados['get_last_adverts'] = $adverts->get_last_adverts($p, $limit, $filtros);

        $this->loadTemplate('home', $dados);
    }

}
