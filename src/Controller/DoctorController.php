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
            return $this->redirectToRoute('show_recepten');
        }

        return $this->render('Dokter/Createrecept.hmtl.twig', ['receptForm' => $form->createView()]);
    }
    /**
     * @Route("/show/recepten", name="show_recepten")
     */
    public function showRecepts(){
        $repository = $this->getDoctrine()->getRepository(Recept::class);
        $recepten = $repository->findAll();
        return $this->render("Dokter/tableRecepten.html.twig", [
            "recepten" => $recepten
        ]);
    }
    /**
     * @Route("/edit/recept/{id}", name="edit_recept")
     */
    public function editMedicineAction($id, Request $request)
    {
        $recept = $this->getDoctrine()->getRepository(Recept::class)->find($id);
        $form = $this->createForm(ReceptType::class, $recept);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recept);
            $entityManager->flush();

            $this->addFlash('success', 'Recept is aangepast!');
            return $this->redirectToRoute('show_recepten');
        }
        return $this->render('Dokter/editRecept.html.twig', [
            'receptForm' => $form->createView(),
            'recept' => $recept
        ]);
    }
    /**
     * @Route("/delete/recept/{id}", name="delete_recept")
     */
    public function deleteMedicineAction($id) {
        $em = $this->getDoctrine()->getManager();
        $recept = $this->getDoctrine()->getRepository(Recept::class)->find($id);
        $em->remove($recept);
        $em->flush();

        $this->addFlash('success', 'Recept is verwijdert!');
        return $this->redirectToRoute('show_recepten');
    }
}