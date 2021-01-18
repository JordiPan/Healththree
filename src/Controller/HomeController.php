<?php
namespace App\Controller;


use App\Entity\Medicines;
use App\Form\MedicijnType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
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

    /**
     * @Route("/medicine/add", name="medicine_maker")
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
            return $this->redirectToRoute('table');
        }



        return $this->render('Bezoeker/createMedicine.html.twig', [
            'medicineForm' => $form->createView()
        ]);
    }

    /**
     * @Route("Medicine/edit/{id}", name="edit_medicine")
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
            return $this->redirectToRoute('table');
        }


        return $this->render('Bezoeker/editMedicine.html.twig', [
            'medicineForm' => $form->createView(),
           'medicine' => $medicine
        ]);

    }
    /**
     * @Route("Medicine/delete/{id}", name="delete_medicine")
     */
    public function deleteMedicineAction($id) {
        $em = $this->getDoctrine()->getManager();
        $medicine = $this->getDoctrine()->getRepository(Medicines::class)->find($id);
        $em->remove($medicine);
        $em->flush();

        $this->addFlash('success', 'Medicijn is verwijdert!');
        return $this->redirectToRoute('table');
    }
}