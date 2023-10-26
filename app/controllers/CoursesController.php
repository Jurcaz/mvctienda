<?php

class CoursesController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = $this->model('Course');
    }

    public function index()
    {
        $session = new Session();

        if($session->getLogin()){

            $courses = $this->model->getCourses();

            $dataView = [
                'title' => 'Cursos en linea',
                'back' => 'courses',
                'menu' => true,
                'coursesList' => $courses,
            ];

            $this->view('courses/index', $dataView);

        } else {
            header('location' . ROOT);
        }
    }


}