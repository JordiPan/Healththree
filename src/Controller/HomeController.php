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
    /**
     * @Route("door/{title}", name="commentSection")
     */
    public function show($title, EntityManagerInterface $em) {
        $repository = $em->getRepository(Medicines::class);
        $medicine = $repository->findOneBy(['id' => 1]);

        if (!$medicine) {
            throw $this->createNotFoundException(sprintf("no Medicine found"));
        }

        $comments = [
            'why die?',
            'just live',
            'eat sht',
            'I kill problems with knowledge'
        ];
        return $this->render('showComments.html.twig', [
            'title' => ucwords(str_replace('-',' ', $title)),
            'comments' => $comments,
            'medicine' => $medicine
        ]);
    }
    /**
     * @Route("table")
     */
    public function showTable() {
        return new Response("Bruh");
    }
}