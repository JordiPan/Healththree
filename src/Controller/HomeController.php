<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    /**
     * @Route("/")
     */
    public function showHome() {
        return new Response("Bruh");
    }
    /**
     * @Route("door/{title}")
     */
    public function show($title) {
        $comments = [
            'why die?',
            'just live',
            'eat sht',
            'I kill problems with knowledge'
        ];
        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-',' ', $title)),
            'comments' => $comments
        ]);
    }
    /**
     * @Route("table")
     */
    public function showTable() {
        return new Response("Bruh");
    }
}