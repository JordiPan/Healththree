<?php


namespace App\Controller;


use App\Entity\Recept;
use App\Form\ReceptType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DocterController extends AbstractController
{
    /**
     * @Route("/add/recept", name="add_recept")
     */
    public function addRecept(Request $request){
        $recept = new Recept();
        $form = $this->createForm(ReceptType::class, $recept);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recept);
            $entityManager->flush();
            $this->addFlash('success', 'Recept is toegevoegd!');
            return $this->redirectToRoute('table');
        }

        return $this->render('Dokter/recept.hmtl.twig', ['receptForm' => $form->createView()]);
    }
    /**
     * @Route("/show/recept", name="show_recept")
     */
    public function showRecepts(){
        $repository = $this->getDoctrine()->getRepository(Recept::class);
        $recepten = $repository->findAll();
        return $this->render("Dokter/tableRecepten.html.twig", ["recepten" => $recepten]);
    }
}