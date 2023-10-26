<?php

class SearchController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = $this->model('Search');
    }

    public function products()
    {
        $search = Validate::text($_POST['search'] ?? '');

        if($search != ''){

            $dataSearch = $this->model->getProducts($search);

            if (count($dataSearch) > 0){

                $dataView = [
                    'title' => 'Buscador de productos',
                    'subtitle' => 'Lista de productos relacionados con la busqueda',
                    'menu' => true,
                    'productsList' => $dataSearch,
                ];

                $this->view('search/index', $dataView);
            } else {

                $dataView = [
                    'title' => 'No se encontro producto',
                    'menu' => true,
                    'errors' => [],
                    'subtitle' => 'No se encontro producto',
                    'text' => 'No se encontro ningun producto en relacion con la busqueda',
                    'color' => 'alert-danger',
                    'url' => 'shop',
                    'colorButton' => 'btn-danger',
                    'textButton' => 'Regresar',
                ];

            $this->view('default/mensaje', $dataView);

            }

        } else {
            header('location:' . ROOT . 'shop');
        }

    }

}