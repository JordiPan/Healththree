<?php


namespace App\Controller;


use App\Entity\Medicines;
use App\Entity\Patient;
use App\Form\MedicijnType;
use App\Form\PatientType;
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

    /**
     * @Route("medewerker/patient_table", name="patient_table")
     */
    public function patientTable() {
        $repository = $this->getDoctrine()->getRepository(Patient::class);
        $patients = $repository->findAll();
        return $this->render("Medewerker/tablePatients.html.twig", ["patients" => $patients]);
    }

    /**
     * @Route("medewerker/patient/add", name="patient_maker")
     */
    public function addPatientAction(Request $request)
    {
        $patient=new Patient();
        $form = $this->createForm(PatientType::class, $patient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($patient);
            $entityManager->flush();
            $this->addFlash('success', 'Patiënt is toegevoegd!');
            return $this->redirectToRoute('patient_table');
        }

        return $this->render('Medewerker/createPatient.html.twig', [
            'patientForm' => $form->createView()
        ]);
    }

    /**
     * @Route("medewerker/patient/edit/{id}", name="edit_patient")
     */
    public function editPatientAction($id, Request $request) {
        $patient = $this->getDoctrine()->getRepository(Patient::class)->find($id);
        $form = $this->createForm(PatientType::class, $patient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($patient);
            $entityManager->flush();

            $this->addFlash('success', 'Patiënt is aangepast!');
            return $this->redirectToRoute('patient_table');
        }

        return $this->render('Medewerker/editPatient.html.twig', [
            'patientForm' => $form->createView(),
            'patient' => $patient
        ]);
    }

    /**
     * @Route("medewerker/patient/delete/{id}", name="delete_patient")
     */
    public function deletePatientAction($id) {
        $em = $this->getDoctrine()->getManager();
        $patient = $this->getDoctrine()->getRepository(Patient::class)->find($id);
        $em->remove($patient);
        $em->flush();

        $this->addFlash('success', 'Patiënt is verwijdert!');
        return $this->redirectToRoute('patient_table');
    }
}