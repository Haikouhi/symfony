<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class UserController extends AbstractController
{

    /**
     * @Route("/home", name="home")
     */

    public function profil() : Response
    {
        return $this->render('home/profil.html.twig');
    }
}