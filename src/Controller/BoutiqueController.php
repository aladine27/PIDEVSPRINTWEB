<?php

namespace App\Controller;

use App\Entity\Boutique;
use App\Form\Boutique1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/boutique')]
class BoutiqueController extends AbstractController
{
    #[Route('/', name: 'app_boutique_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $boutiques = $entityManager
            ->getRepository(Boutique::class)
            ->findAll();

        return $this->render('boutique/index.html.twig', [
            'boutiques' => $boutiques,
        ]);
    }

    #[Route('/new', name: 'app_boutique_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $boutique = new Boutique();
        $form = $this->createForm(Boutique1Type::class, $boutique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($boutique);
            $entityManager->flush();

            return $this->redirectToRoute('app_boutique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('boutique/new.html.twig', [
            'boutique' => $boutique,
            'form' => $form,
        ]);
    }

    #[Route('/{idBo}', name: 'app_boutique_show', methods: ['GET'])]
    public function show(Boutique $boutique): Response
    {
        return $this->render('boutique/show.html.twig', [
            'boutique' => $boutique,
        ]);
    }

    #[Route('/{idBo}/edit', name: 'app_boutique_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Boutique $boutique, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Boutique1Type::class, $boutique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_boutique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('boutique/edit.html.twig', [
            'boutique' => $boutique,
            'form' => $form,
        ]);
    }

  #[Route('/{idBo}', name: 'app_boutique_delete', methods: ['POST'])]
public function delete($idBo, Boutique $boutique,EntityManagerInterface $entityManager): Response
{
    $boutique = $entityManager->getRepository(Boutique::class)->find($idBo);

    if (!$boutique) {
        throw $this->createNotFoundException('Boutique non trouvée');
    }

    $entityManager->remove($boutique);
    $entityManager->flush();

    return $this->redirectToRoute('app_boutique_index', [], Response::HTTP_SEE_OTHER);
}


}
