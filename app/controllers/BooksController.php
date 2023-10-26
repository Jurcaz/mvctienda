<?php

class BooksController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Book');
    }

    public function index()
    {
        $session = new Session();

        if($session->getLogin()){

            $books = $this->model->getBooks();

            $dataView = [
                'title' => 'Libros en linea',
                'back' => 'books',
                'menu' => true,
                'booksList' => $books,
            ];

            $this->view('books/index', $dataView);

        } else {
            header('location' . ROOT);
        }
    }
}