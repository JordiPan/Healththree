<?php


namespace App\Controller;


use App\Entity\Recept;
use App\Form\ReceptType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DoctorController extends AbstractController
{
    /**
     * @Route("/dokter/add/recept", name="add_recept")
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
            return $this->redirectToRoute('dokter_homepage');
        }

        return $this->render('Dokter/recept.hmtl.twig', ['receptForm' => $form->createView()]);
    }
    /**
     * @Route("/dokter", name="dokter_homepage")
     */
    public function showRecepts(){
        $repository = $this->getDoctrine()->getRepository(Recept::class);
        $recepten = $repository->findAll();
        return $this->render("Dokter/tableRecepten.html.twig", ["recepten" => $recepten]);
    }
}