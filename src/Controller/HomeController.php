<?php
namespace App\Controller;


use App\Entity\Medicines;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    /**
     * @Route("/", name="homepage")
     */
    public function showHome() {
        return $this->render('home.html.twig');
    }

}