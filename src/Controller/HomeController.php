<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Produit;



class HomeController extends AbstractController {
    /**
     * @Route("/home", name="home")
     */

    public function home() : Response {

        // $p = new Produit;

        // $p->setTitre('Nouveau produit')
        //   ->setDescription('lorem ipsum')
        //   ->setNote(4)
        //   ->setPrix(10.90);

        
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($p);

        // $em->flush();


        $repository = $this->getDoctrine()->getRepository(Produit::class);

        // dump($repository);

        // $test1 = $repository->findAll();
        // $test2 = $repository->find(0);
        // $test3 = $repository->findOneBy(['note' => 4]);

        // dump($test1);
        // dump($test2);
        // dump($test3);





        return $this->render('home/home.html.twig');
    }
}