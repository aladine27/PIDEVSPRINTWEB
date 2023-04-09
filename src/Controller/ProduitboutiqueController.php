<?php


namespace App\Controller;

use App\Entity\Produitboutique;
use App\Form\ProduitboutiqueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produitboutique')]
class ProduitboutiqueController extends AbstractController
{
    #[Route('/', name: 'app_produitboutique_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $produitboutiques = $entityManager
            ->getRepository(Produitboutique::class)
            ->findAll();

        return $this->render('produitboutique/index.html.twig', [
            'produitboutiques' => $produitboutiques,
        ]);
    }

   #[Route('/produitboutique/new', name: 'app_produitboutique_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produitboutique = new Produitboutique();
        $form = $this->createForm(ProduitboutiqueType::class, $produitboutique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            if ($file) {
                $fileName = uniqid() . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );

                $produitboutique->setImage($fileName);
            }

            $entityManager->persist($produitboutique);
            $entityManager->flush();

            return $this->redirectToRoute('app_produitboutique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produitboutique/new.html.twig', [
            'produitboutique' => $produitboutique,
            'form' => $form,
        ]);
    }

#[Route('/{id}/show', name: 'app_produitboutique_show', methods: ['GET', 'POST'])]
 public function show(Produitboutique $produitboutique): Response
    {
        return $this->render('produitboutique/show.html.twig', [
            'produitboutique' => $produitboutique,
        ]);
    }
    #[Route('/{id}/edit', name: 'app_produitboutique_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produitboutique $produitboutique, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitboutiqueType::class, $produitboutique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_produitboutique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produitboutique/edit.html.twig', [
            'produitboutique' => $produitboutique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produitboutique_delete', methods: ['POST'])]
    public function delete(Request $request, Produitboutique $produitboutique, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produitboutique->getId(), $request->request->get('_token'))) {
            $entityManager->remove($produitboutique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produitboutique_index', [], Response::HTTP_SEE_OTHER);
    }
}