<?php


namespace App\Controller;


use App\Entity\Medicines;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends AbstractController
{
    /**
     * @Route("/table", name="table")
     */
    public function showTable(EntityManagerInterface $em) {
        $repository = $this->getDoctrine()->getRepository(Medicines::class);
        $medicines = $repository->findAll();
        return $this->render("table.html.twig", ["medicines" => $medicines]);
    }
}