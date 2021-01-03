<?php
namespace App\Controller;

use App\Entity\Medicines;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MedicineAdminController extends AbstractController{
    /**
     * @Route("/admin/medicine")
     */
    public function new(EntityManagerInterface $em) {
        $medicine = new Medicines();
        $medicine->setNaam("Ibuprofen");
        $medicine->setWerking("Geen idee");
        $medicine->setPrijs(1.99);
        $medicine->setVerzekerd(1);

        $em->persist($medicine);
        $em->flush();
        return new Response(sprintf(
            "regel aangemaakt in Medicines tabel. Regel: %d",
        $medicine->getId()
        ));
    }
}