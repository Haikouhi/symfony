<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class HomeController {
    private $twig;
    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function home() : Response {
        return Response($this->twig->render('home.html.twig'));
    }
}