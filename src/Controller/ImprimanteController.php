<?php

namespace App\Controller;

use App\Entity\Imprimante;
use App\Form\ImprimanteType;
use App\Repository\ImprimanteRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ImprimanteController extends AbstractController
{
    private $imprimanteRepository;
    private $reservationRepository;

    public function __construct(ImprimanteRepository $imprimanteRepository, ReservationRepository $reservationRepository)
    {
        $this->imprimanteRepository = $imprimanteRepository;
        $this->reservationRepository = $reservationRepository;
    }

    /**
     * @Route("/admin/create/imprimante", name="create_imprimante")
     */
    public function createImprimante(EntityManagerInterface $em, Request $request): Response
    {
        $imprimante = new Imprimante;
        $form = $this->createForm(ImprimanteType::class, $imprimante);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($imprimante);
            $em->flush();
            return $this->redirectToRoute("admin");
        }
        $formView = $form->createView();

        return $this->render('imprimante/create.html.twig', [
            'formView' => $formView
        ]);
    }

    /**
     * @Route("/admin/list/imprimantes", name="list_imprimantes")
     */
    public function showImprimantes(ImprimanteRepository $imprimanteRepository): Response
    {
        $imprimantes = $imprimanteRepository->findAll();
        return $this->render('imprimante/showList.html.twig', [
            "imprimantes" => $imprimantes
        ]);
    }

    /**
     * @Route("/admin/imprimante/{id}/edit", name="edit_imprimante")
     */
    public function edit($id, ImprimanteRepository $imprimanteRepository, Request $request, EntityManagerInterface $em): Response
    {
        $imprimante = $imprimanteRepository->find($id);

        $form = $this->createForm(ImprimanteType::class, $imprimante);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute("admin");
        }
        $formView = $form->createView();

        return $this->render('imprimante/edit.html.twig', [
            'imprimante' => $imprimante,
            'formView' => $formView
        ]);
    }

    /**
     * @Route("/admin/imprimante/{id}/delete", name="delete_imprimante")
     */
    public function delete($id, ImprimanteRepository $imprimanteRepository, Request $request, EntityManagerInterface $em): Response
    {

        return $this->redirectToRoute("list_imprimantes");
    }

    public function findFreePrinter($dateDebut, $dateFin)
    {
        $countImprimante = $this->imprimanteRepository->findAll();
        $reservation = $this->reservationRepository->findBy(['Date_debut' => $dateDebut]);
        $imprimante = $this->imprimanteRepository->findBy(["ImpriStatus" => "LIBRE"], null, 1);

        return $imprimante;
    }
}
