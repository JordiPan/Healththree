<?php


namespace App\Controller;


use App\Entity\Patient;
use App\Entity\Recept;
use App\Form\ReceptType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DokterController extends AbstractController
{
    /**
     * @Route("/dokter", name="dokter_home")
     */
    public function showHome() {
        return $this->render('Dokter/dokterHome.html.twig');
    }

    /**
     * @Route("dokter/add/recipe", name="add_recipe")
     */
    public function addRecipe(Request $request){
        $recept = new Recept();
        $form = $this->createForm(ReceptType::class, $recept);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recept);
            $entityManager->flush();
            $this->addFlash('success', 'Recept is toegevoegd!');
            return $this->redirectToRoute('recipe_table');
        }

        return $this->render('Dokter/createRecipe.hmtl.twig', ['receptForm' => $form->createView()]);
    }
    /**
     * @Route("dokter/recipe_table", name="recipe_table")
     */
    public function showRecipes(){
        $repository = $this->getDoctrine()->getRepository(Recept::class);
        $recepten = $repository->findAll();
        return $this->render("Dokter/tableRecipes.html.twig", ["recepten" => $recepten]);
    }

    /**
     * @Route("dokter/recipe/edit/{id}", name="edit_recipe")
     */
    public function editRecipeAction($id, Request $request) {
        $recept = $this->getDoctrine()->getRepository(Recept::class)->find($id);
        $form = $this->createForm(ReceptType::class, $recept);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recept);
            $entityManager->flush();

            $this->addFlash('success', 'Recept is aangepast!');
            return $this->redirectToRoute('recipe_table');
        }


        return $this->render('Dokter/editRecipe.html.twig', [
            'receptForm' => $form->createView(),
            'recept' => $recept
        ]);

    }
    /**
     * @Route("dokter/recipe/delete/{id}", name="delete_recipe")
     */
    public function deleteRecipeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $recipe = $this->getDoctrine()->getRepository(Recept::class)->find($id);
        $em->remove($recipe);
        $em->flush();

        $this->addFlash('success', 'Recept is verwijdert!');
        return $this->redirectToRoute('recipe_table');
    }
    /**
     * @Route("dokter/patient_table", name="doctor_patient_table")
     */
    public function showPatients(){
        $repository = $this->getDoctrine()->getRepository(Patient::class);
        $patients = $repository->findAll();
        return $this->render("Dokter/tablePatients.html.twig", ["patients" => $patients]);
    }
}