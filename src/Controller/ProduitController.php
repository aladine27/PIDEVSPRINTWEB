<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit')]
class ProduitController extends AbstractController
{
    #[Route('/', name: 'app_produit_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupération de tous les produits depuis la base de données
        $produits = $entityManager
            ->getRepository(Produit::class)
            ->findAll();

        // Affichage de la liste des produits
        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EventRepository $eventRepository): Response
    {
        // Création d'un nouveau produit et de son formulaire associé
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);

        // Traitement du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrement du produit dans la base de données
            $entityManager->persist($produit);
            $entityManager->flush();

            // Redirection vers la liste des produits
            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        // Affichage du formulaire de création d'un produit
        return $this->renderForm('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
            'event_names' => $eventRepository->findAllNames(),
        ]);
    }

    #[Route('/{idProd}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        // Affichage des détails d'un produit
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{idProd}/edit', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        // Création du formulaire d'édition d'un produit
        $form = $this->createForm(ProduitType::class, $produit);

        // Traitement du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrement des modifications du produit dans la base de données
            $entityManager->flush();

            // Redirection vers la liste des produits
            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        // Affichage du formulaire d'édition d'un produit
        return $this->renderForm('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{idProd}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
{
// Vérification que la requête est bien de type POST
if ($request->isMethod('POST')) {
// Suppression du produit de la base de données
$entityManager->remove($produit);
$entityManager->flush();
}
   // Redirection vers la liste des produits
    return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
}



}