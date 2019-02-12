<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;


class HomeController {

    public function hello() : Response {
        return 'hello';
    }
}