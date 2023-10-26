<?php

class ShopController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Shop');
    }

    public function index()
    {
        $session = new Session();

        $mostSold = $this->model->mostSold();
        $news = $this->model->getNews();

        if ($session->getLogin()) {
            $dataView = [
                'title' => 'Bienvenid@ a nuestra exclusiva tienda de productos',
                'subtitle' => 'Lista de productos mas vendidos',
                'subtitle2' => 'Lista de productos nuevos',
                'menu' => true,
                'mostSoldList' => $mostSold,
                'news' => $news,
            ];

            $this->view('shop/index', $dataView);
        } else {
            header('location:' . ROOT);
        }
    }

    public function logout()
    {
        $session = new Session();
        $session->logout();

        header('location:' . ROOT);
    }

    public function show($id, $back = '')
    {
        $session = new Session();

        $product = $this->model->getProductById($id);

        $data = [
            'title' => 'Detalle del producto',
            'subtitle' => $product->name,
            'menu' => true,
            'admin' => false,
            'back' => $back,
            'errors' => [],
            'product' => $product,
            'user_id' => $session->getUserId(),
        ];

        $this->view('shop/show', $data);

    }

    public function whoami()
    {
        $session = new Session();

        if($session->getLogin()){

            $dataView = [
              'title' => 'Quienes somos',
              'menu' => true,
              'active' => 'whoami',
            ];

            $this->view('shop/whoami', $dataView);
        } else {
            header('location:' . ROOT);
        }
    }

    public function contact()
    {
        $errors = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $name = Validate::text($_POST['name'] ?? '');
            $email = Validate::text($_POST['email'] ?? '');
            $message = Validate::text($_POST['message'] ?? '');

            if($name == '') array_push($errors, 'El nombre es requerido');
            if($email == '') array_push($errors, 'El email es requerido');
            if($message == '') array_push($errors, 'El mensaje es requerido');

            if (count($errors) == 0) {
                if ( $this->model->sendEmail($name, $email, $message)) {
                    $dataView = [
                        'title' => 'Mensaje de usuario',
                        'menu' => true,
                        'errors' => $errors,
                        'subtitle' => 'Gracias por su mensaje',
                        'text' => 'En breve recibirá noticias nuestras',
                        'color' => 'alert-success',
                        'url' => 'shop',
                        'colorButton' => 'btn-success',
                        'textButton' => 'Regresar',
                    ];
                } else {
                    $dataView = [
                        'title' => 'Error en el envió del correo',
                        'menu' => true,
                        'errors' => [],
                        'subtitle' => 'Error en el envió del correo',
                        'text' => 'Existió un problema durante el proceso de envío del correo electrónico',
                        'color' => 'alert-danger',
                        'url' => 'shop',
                        'colorButton' => 'btn-danger',
                        'textButton' => 'Regresar',
                    ];
                }
                $this->view('default/mensaje', $dataView);
            } else {
                $dataView = [
                    'title' => 'Contacta con nosotros',
                    'menu' => true,
                    'errors' => $errors,
                    'active' => 'contact',
                ];

                $this->view('shop/contact', $dataView);
            }
        } else {

            $session = new Session();

            if($session->getLogin()){

                $dataView = [
                    'title' => 'Contacta con nosotros',
                    'menu' => true,
                    'active' => 'contact',
                ];

                $this->view('shop/contact', $dataView);

            } else {
                header('location:' . ROOT);
            }

        }


    }


}