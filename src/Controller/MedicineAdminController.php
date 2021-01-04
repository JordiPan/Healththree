<?php
namespace App\Controller;
use App\Entity\Medicines;
use App\Form\MedicijnType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MedicineAdminController extends AbstractController {
    /**
     * @Route("/admin/medicine", name="medicine_maker")
     */
    public function newMedicine(Request $request)
    {
        $medicijn=new Medicines();
       $form = $this->createForm(MedicijnType::class, $medicijn);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medicijn);
            $entityManager->flush();

            return $this->redirectToRoute('table');
        }



        return $this->render('create.html.twig', [
           'medicineForm' => $form->createView()
       ]);
    }
}