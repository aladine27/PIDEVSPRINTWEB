<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Form\SearchEventType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\Tools\Pagination\Paginator;




#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/home', name: 'app_event_indexHome', methods: ['GET', 'POST'])]
    public function indexHome(Request $request, EventRepository $eventRepository): Response
    {
        $sort_by_nom_event = $request->query->get('sort_by_nom_event');
        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();
    
       
        return $this->render('front/index.html.twig', [
            'events' => $events,
        ]);
    }
    
    #[Route('/', name: 'app_event_index', methods: ['GET', 'POST'])]
    public function index(Request $request2, Request $request, EventRepository $eventRepository): Response
    {
        //  $sort_by_nom_event = $request->query->get('sort_by_nom_event');
  
        // $eventss = $this->getDoctrine()->getRepository(Event::class)->findAll();
    
        // if ($sort_by_nom_event) {
        //     usort($eventss, function($a, $b) {
        //         return $a->getNomEvent() <=> $b->getNomEvent();
        //     });
        // }
        $form = $this->createForm(SearchEventType::class);
        $search = $form->handleRequest($request2);

        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository(Event::class)
            ->createQueryBuilder('u');
        $events  = new Paginator($query);
        $currentPage = $request->query->getInt('page', 1);

        $itemsPerPage = 3;
        $events
        ->getQuery()
        ->setFirstResult($itemsPerPage * ($currentPage - 1))
        ->setMaxResults($itemsPerPage);
         $totalItems = count($events);
         $pagesCount = ceil($totalItems / $itemsPerPage);

         if ($form->isSubmitted() && $form->isValid()) {
            $events =  $eventRepository->search($search->get('mots')->getData());
            // $events = new Paginator($eventRepository->findBy([], ['date_event' => 'DESC']));
            $currentPage = $request->query->getInt('page', 1);
            $totalItems = count($events);
            $pagesCount = ceil($totalItems / $itemsPerPage);
            return $this->render('event/index.html.twig', [
                'form' => $form->createView(),
                'events' => $events,
                'currentPage' => $currentPage,
                'pagesCount' => $pagesCount,
            ]);
        }
      
    
        return $this->render('event/index.html.twig', [
            'events' => $events,
            'form' => $form->createView(),
            'currentPage' => $currentPage,
            'pagesCount' => $pagesCount,
            // 'eventss' => $eventss,

        ]);
    }
    

    #[Route('/new', name: 'app_event_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EventRepository $eventRepository): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

             // Vérification que la date de fin est supérieure ou égale à la date de début
             if ($event->getDateFin() < $event->getDateDeb()) {
                $form->get('date_fin')->addError(new FormError('La date de fin doit être supérieure ou égale à la date de début'));
                return $this->renderForm('event/new.html.twig', [
                    'event' => $event,
                    'form' => $form,
                ]);
            }


            $eventRepository->save($event, true);

           

            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/new.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/{nom_event}', name: 'app_event_show', methods: ['GET'])]
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/{nom_event}/edit', name: 'app_event_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Event $event, EventRepository $eventRepository): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventRepository->save($event, true);

            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/edit.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/{nom_event}', name: 'app_event_delete', methods: ['POST'])]
    public function delete(Request $request, Event $event, EventRepository $eventRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getNomEvent(), $request->request->get('_token'))) {
            $eventRepository->remove($event, true);
        }

        return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
    }
}
