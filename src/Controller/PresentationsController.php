<?php

namespace App\Controller;

use App\Entity\Presentations;
use App\Form\PresentationsType;
use App\Repository\PresentationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/presentations')]
class PresentationsController extends AbstractController
{
    #[Route('/', name: 'presentations_index', methods: ['GET'])]
    public function index(PresentationsRepository $presentationsRepository): Response
    {
        return $this->render('presentations/index.html.twig', [
            'presentations' => $presentationsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'presentations_new', methods: ['GET', 'POST'])]
    public function new(Request $request,  SluggerInterface $slugger): Response
    {
        $presentation = new Presentations();
        $form = $this->createForm(PresentationsType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
            $photoPresentation = $form->get('photoPresentation')->getData();

if ($photoPresentation) {
$originalFilename = pathinfo($photoPresentation->getClientOriginalName(),PATHINFO_FILENAME);

$safeFilename = $slugger->slug($originalFilename);
$newFilename = $safeFilename.'-'.uniqid().'.'.$photoPresentation->guessExtension();

try {
    $photoPresentation->move(
    $this->getParameter('photos_directory'),
    $newFilename
    );
    } catch (FileException $e) {

    }
    $presentation->setphotopresentation($newFilename);
}
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($presentation);
            $entityManager->flush();

            return $this->redirectToRoute('presentations_index');
        }

        return $this->render('presentations/new.html.twig', [
            'presentation' => $presentation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'presentations_show', methods: ['GET'])]
    public function show(Presentations $presentation): Response
    {
        return $this->render('presentations/show.html.twig', [
            'presentation' => $presentation,
        ]);
    }

    #[Route('/{id}/edit', name: 'presentations_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SluggerInterface $slugger): Response
    {
        $presentation = new Presentations();
        $form = $this->createForm(PresentationsType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photoPresentation= $form->get('photoPresentation')->getData();

            if ($photoPresentation) {
            $originalFilename = pathinfo($photoPresentation->getClientOriginalName(),PATHINFO_FILENAME);
            
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$photoPresentation->guessExtension();
            
            try {
                $photoPresentation->move(
                $this->getParameter('photos_directory'),
                $newFilename
                );
                } catch (FileException $e) {
            
                }
                $presentation->setphotopresentation($newFilename);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('presentations_index');
        }

        return $this->render('presentations/edit.html.twig', [
            'presentation' => $presentation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'presentations_delete', methods: ['POST'])]
    public function delete(Request $request, Presentations $presentation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$presentation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($presentation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('presentations_index');
    }
}
