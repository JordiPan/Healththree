<?php
namespace App\Controller;
use App\Entity\Recept;
use App\Form\ReceptType;
use App\Repository\ReceptRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApothekerController extends AbstractController
{
    /**
     * @Route("/apotheker", name="apotheker_home")
     */
    public function showHome() {
        return $this->render('Apotheker/apotheker.html.twig');
    }

    /**
     * @Route("apotheker/table", name="apotheker_recipe_table")
     */
    public function showTable() {
        $repository = $this->getDoctrine()->getRepository(Recept::class);
        $recepten = $repository->findAll();
        return $this->render("Apotheker/tableRecipes.html.twig", ["recepten" => $recepten]);
    }
}