<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Form\ContactsType;
use App\Repository\ContactsRepository;
use App\Repository\ParcoursRepository;
use App\Repository\CreationsRepository;
use App\Repository\TechnologiesRepository;
use App\Repository\PresentationsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]

    public function index(PresentationsRepository $presentationRepository, TechnologiesRepository $technologiesRepository, CreationsRepository $creationsRepository,  ParcoursRepository $parcoursRepository,ContactsRepository $contactsRepository,Request $request): Response
    {
        $contact = new Contacts();
        $form = $this->createForm(ContactsType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('home/index.html.twig', [
            'Presentations' => $presentationRepository->findAll(),
            'technologies' => $technologiesRepository->findAll(),
            'creations' => $creationsRepository->findAll(),
            'parcours' => $parcoursRepository->findAll(),
            'contacts' => $parcoursRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
}
