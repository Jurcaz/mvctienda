<?php

class AdminproductController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('AdminProduct');
    }

    public function index()
    {
        $session = new Session();

        if ($session->getLogin()) {
            $productsList = $this->model->getProducts();
            $typeList = $this->model->getConfig('productType');

            $dataView = [
                'title' => 'Administración de Productos',
                'menu' => false,
                'admin' => true,
                'productList' => $productsList,
                'typeList' => $typeList,
            ];

            $this->view('admin/products/index', $dataView);
        } else {
            header('location:' . ROOT . 'admin');
        }
    }

    public function create()
    {
        $errors = [];
        $dataForm = [];
        $typeList = $this->model->getConfig(PRODUCT_TYPE);
        $statusList = $this->model->getConfig(PRODUCT_STATUS);
        $catalogue = $this->model->getCatalogue();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //echo 'POST: ';
            //var_dump($_POST);

            //Recibimos la información
            $type = $_POST['type'] ?? '';
            $name = Validate::text($_POST['name'] ?? '');
            $description = Validate::text($_POST['description'] ?? '');
            $price = Validate::number($_POST['price'] ?? '');
            $discount = Validate::number($_POST['discount'] ?? '0');
            $send = Validate::number($_POST['send'] ?? '0');
            $image = Validate::file($_FILES['image']['name']);
            $published = $_POST['published'] ?? '';
            $relation1 = $_POST['relation1'] != '' ? $_POST['relation1'] : 0;
            $relation2 = $_POST['relation2'] != '' ? $_POST['relation2'] : 0;
            $relation3 = $_POST['relation3'] != '' ? $_POST['relation3'] : 0;
            $mostSold = isset($_POST['mostSold']) ?? '1';
            $new = isset($_POST['new']) ?? '1';
            $status = $_POST['status'] ?? '';
            //Books
            $author = Validate::text($_POST['author'] ?? '');
            $publisher = Validate::text($_POST['publisher'] ?? '');
            $pages = Validate::number($_POST['pages'] ?? '');
            //Courses
            $people = Validate::text($_POST['people'] ?? '');
            $objetives = Validate::text($_POST['objetives'] ?? '');
            $necesites = Validate::text($_POST['necesites'] ?? '');

            //Validamos la información
            if (empty($name)) {
                array_push($errors, 'El nombre del producto es requerido');
            }
            if (empty($description)) {
                array_push($errors, 'La descripción del producto es requerida');
            }
            if ( ! is_numeric($price)) {
                array_push($errors, 'El precio del producto debe ser un número');
            }
            if ( ! is_numeric($discount)) {
                array_push($errors, 'El descuento del producto debe ser un número');
            }
            if ( ! is_numeric($send)) {
                array_push($errors, 'Los gastos de envío del producto deben ser un número');
            }
            if (is_numeric($price) && is_numeric($discount) && $price < $discount) {
                array_push($errors, 'El descuento no puede ser mayor que el precio');
            }
            if ( ! is_numeric($pages)) {
                $pages = 0;
            }
            if ($type == 1) {
                if (empty($people)) {
                    array_push($errors, 'El público objetivo es requerido');
                }
                if (empty($objetives)) {
                    array_push($errors, 'Los objetivos del curso son requeridos');
                }
                if (empty($necesites)) {
                    array_push($errors, 'Los requisitos del curso son necesarios');
                }
            } elseif ($type == 2) {
                if (empty($author)) {
                    array_push($errors, 'El autor del libro es requerido');
                }
                if (empty($publisher)) {
                    array_push($errors, 'La editorial del libro es requerida');
                }
            } else {
                array_push($errors, 'Debes seleccionar un tipo válido');
            }
            if ( ! Validate::date($published) ) {
                array_push($errors, 'La fecha o su formato no son correctos');
            } elseif (Validate::dateDif($published)) {
                array_push($errors, 'La fecha de publicación no puede ser posterior a hoy');
            }

            if ($image) {
                if (Validate::imageFile($_FILES['image']['tmp_name'])) {
                    //Comenzamos a tratar la imagen una vez validad
                    $image = strtolower($image);

                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                        move_uploaded_file($_FILES['image']['tmp_name'], 'img' . ROOT . $image);
                        Validate::resizeImage($image, 240);
                    } else {
                        array_push($errors, 'Error al subir la imagen');
                    }
                } else {
                    array_push($errors, 'El formato de imagen no es aceptado');
                }
            } else {
                array_push($errors, 'No he recibido la imagen');
            }

            //Creamos el array de datos
            $dataForm = [
                'type' => $type,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'discount' => $discount,
                'send' => $send,
                'image' => $image,
                'published' => $published,
                'author' => $author,
                'publisher' => $publisher,
                'pages' => $pages,
                'people' => $people,
                'objetives' => $objetives,
                'necesites' => $necesites,
                'mostSold' => $mostSold,
                'new' => $new,
                'relation1' => $relation1,
                'relation2' => $relation2,
                'relation3' => $relation3,
                'status' => $status,
            ];

            //echo 'DataForm: ';
            //var_dump($dataForm);

            if (empty($errors)) {

                //Enviar la información al modelo y valorar
                if ($this->model->createProduct($dataForm)) {
                    //Redirigimos al index de productos
                    header('location:' . ROOT . 'adminproduct');
                }
                array_push($errors, 'Se ha producido un error durante la inserción en la BD');
            }

        }

        $dataView = [
            'title' => 'Administración de Productos - Alta',
            'menu' => false,
            'admin' => true,
            'errors' => $errors,
            'typeList' => $typeList,
            'statusList' => $statusList,
            'catalogue' => $catalogue,
            'dataForm' => $dataForm,
        ];
        //var_dump($dataView['statusList']);

        $this->view('admin/products/create', $dataView);
    }

    public function update($id)
    {
        $errors = [];
        $typeList = $this->model->getConfig(PRODUCT_TYPE);
        $statusList = $this->model->getConfig(PRODUCT_STATUS);
        $catalogue = $this->model->getCatalogue();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Recibimos la información
            $type = $_POST['type'] ?? '';
            $name = Validate::text($_POST['name'] ?? '');
            $description = Validate::text($_POST['description'] ?? '');
            $price = Validate::number($_POST['price'] ?? '');
            $discount = Validate::number($_POST['discount'] ?? '0');
            $send = Validate::number($_POST['send'] ?? '0');
            $image = Validate::file($_FILES['image']['name']);
            $published = $_POST['published'] ?? '';
            $relation1 = $_POST['relation1'] != '' ? $_POST['relation1'] : 0;
            $relation2 = $_POST['relation2'] != '' ? $_POST['relation2'] : 0;
            $relation3 = $_POST['relation3'] != '' ? $_POST['relation3'] : 0;
            $mostSold = isset($_POST['mostSold']) ?? '1';
            $new = isset($_POST['new']) ?? '1';
            $status = $_POST['status'] ?? '';
            //Books
            $author = Validate::text($_POST['author'] ?? '');
            $publisher = Validate::text($_POST['publisher'] ?? '');
            $pages = Validate::number($_POST['pages'] ?? '');
            //Courses
            $people = Validate::text($_POST['people'] ?? '');
            $objetives = Validate::text($_POST['objetives'] ?? '');
            $necesites = Validate::text($_POST['necesites'] ?? '');

            //Validamos la información
            if (empty($name)) {
                array_push($errors, 'El nombre del producto es requerido');
            }
            if (empty($description)) {
                array_push($errors, 'La descripción del producto es requerida');
            }
            if ( ! is_numeric($price)) {
                array_push($errors, 'El precio del producto debe ser un número');
            }
            if ( ! is_numeric($discount)) {
                array_push($errors, 'El descuento del producto debe ser un número');
            }
            if ( ! is_numeric($send)) {
                array_push($errors, 'Los gastos de envío del producto deben ser un número');
            }
            if (is_numeric($price) && is_numeric($discount) && $price < $discount) {
                array_push($errors, 'El descuento no puede ser mayor que el precio');
            }
            if ( ! is_numeric($pages)) {
                $pages = 0;
            }
            if ($type == 1) {
                if (empty($people)) {
                    array_push($errors, 'El público objetivo es requerido');
                }
                if (empty($objetives)) {
                    array_push($errors, 'Los objetivos del curso son requeridos');
                }
                if (empty($necesites)) {
                    array_push($errors, 'Los requisitos del curso son necesarios');
                }
            } elseif ($type == 2) {
                if (empty($author)) {
                    array_push($errors, 'El autor del libro es requerido');
                }
                if (empty($publisher)) {
                    array_push($errors, 'La editorial del libro es requerida');
                }
            } else {
                array_push($errors, 'Debes seleccionar un tipo válido');
            }
            if ( ! Validate::date($published) ) {
                array_push($errors, 'La fecha o su formato no son correctos');
            } elseif (Validate::dateDif($published)) {
                array_push($errors, 'La fecha de publicación no puede ser posterior a hoy');
            }

            if ($image) {
                if (Validate::imageFile($_FILES['image']['tmp_name'])) {
                    //Comenzamos a tratar la imagen una vez validad
                    $image = strtolower($image);

                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                        move_uploaded_file($_FILES['image']['tmp_name'], 'img' . ROOT . $image);
                        Validate::resizeImage($image, 240);
                    } else {
                        array_push($errors, 'Error al subir la imagen');
                    }
                } else {
                    array_push($errors, 'El formato de imagen no es aceptado');
                }
            }

            //Creamos el array de datos
            $dataForm = [
                'id' => $id,
                'type' => $type,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'discount' => $discount,
                'send' => $send,
                'image' => $image,
                'published' => $published,
                'author' => $author,
                'publisher' => $publisher,
                'pages' => $pages,
                'people' => $people,
                'objetives' => $objetives,
                'necesites' => $necesites,
                'mostSold' => $mostSold,
                'new' => $new,
                'relation1' => $relation1,
                'relation2' => $relation2,
                'relation3' => $relation3,
                'status' => $status,
            ];

            if (empty($errors)) {
                //Enviar la información al modelo
                if ($this->model->updateProduct($dataForm)) {
                    //Redirigimos al index de productos
                    header('location:' . ROOT . 'adminproduct');
                }
                array_push($errors, 'Se ha producido un error durante la actualización en la BD');
            }
        }

        $product = $this->model->getProductById($id);

        $dataView = [
            'title' => 'Administración de Productos - Alta',
            'menu' => false,
            'admin' => true,
            'errors' => $errors,
            'typeList' => $typeList,
            'statusList' => $statusList,
            'catalogue' => $catalogue,
            'product' => $product,
        ];

        $this->view('admin/products/update', $dataView);
    }

    public function delete($id)
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if ($this->model->deleteProduct($id)) {
                header('location:' . ROOT . 'adminproduct' );
            } else {
                array_push($errors, 'No se ha podido borrar el registro');
            }
        }

        $typeList = $this->model->getConfig(PRODUCT_TYPE);
        $product = $this->model->getProductById($id);

        $dataView = [
            'title' => 'Administracion de productos - Baja',
            'menu' => false,
            'admin' => true,
            'errors' => $errors,
            'typeList' => $typeList,
            'product' => $product,
        ];

        $this->view('admin/products/delete', $dataView);
    }


}