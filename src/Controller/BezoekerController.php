<?php
namespace App\Controller;


use App\Entity\Medicines;
use App\Form\MedicijnType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BezoekerController extends AbstractController {
    /**
     * @Route("/", name="homepage")
     */
    public function showHome() {
        return $this->render('Bezoeker/home.html.twig');
    }

    /**
     * @Route("/table", name="table")
     */
    public function showTable() {
        $repository = $this->getDoctrine()->getRepository(Medicines::class);
        $medicines = $repository->findAll();
        return $this->render("Bezoeker/tableMedicine.html.twig", ["medicines" => $medicines]);
    }
}