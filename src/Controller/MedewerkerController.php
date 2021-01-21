<?php


namespace App\Controller;


use App\Entity\Medicines;
use App\Form\MedicijnType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MedewerkerController extends AbstractController
{
    /**
     * @Route("/medewerker", name="medewerker_home")
     */
    public function showHome() {
        return $this->render('Medewerker/medewerkerHome.html.twig');
    }

    /**
     * @Route("medewerker/table", name="medewerker_table")
     */
    public function showTable() {
        $repository = $this->getDoctrine()->getRepository(Medicines::class);
        $medicines = $repository->findAll();
        return $this->render("Medewerker/tableMedicine.html.twig", ["medicines" => $medicines]);
    }

    /**
     * @Route("medewerker/medicine/add", name="medicine_maker")
     */
    public function addMedicineAction(Request $request)
    {
        $medicine=new Medicines();
        $form = $this->createForm(MedicijnType::class, $medicine);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medicine);
            $entityManager->flush();
            $this->addFlash('success', 'Medicijn is toegevoegd!');
            return $this->redirectToRoute('medewerker_table');
        }

        return $this->render('Medewerker/createMedicine.html.twig', [
            'medicineForm' => $form->createView()
        ]);
    }

    /**
     * @Route("medewerker/medicine/edit/{id}", name="edit_medicine")
     */
    public function editMedicineAction($id, Request $request) {
        $medicine = $this->getDoctrine()->getRepository(Medicines::class)->find($id);
        $form = $this->createForm(MedicijnType::class, $medicine);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medicine);
            $entityManager->flush();

            $this->addFlash('success', 'Medicijn is aangepast!');
            return $this->redirectToRoute('medewerker_table');
        }


        return $this->render('Medewerker/editMedicine.html.twig', [
            'medicineForm' => $form->createView(),
            'medicine' => $medicine
        ]);

    }
    /**
     * @Route("medewerker/medicine/delete/{id}", name="delete_medicine")
     */
    public function deleteMedicineAction($id) {
        $em = $this->getDoctrine()->getManager();
        $medicine = $this->getDoctrine()->getRepository(Medicines::class)->find($id);
        $em->remove($medicine);
        $em->flush();

        $this->addFlash('success', 'Medicijn is verwijdert!');
        return $this->redirectToRoute('medewerker_table');
    }
}