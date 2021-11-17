<?php

namespace App\Controller;

use App\Entity\Technologies;
use App\Form\TechnologiesType;
use App\Repository\TechnologiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/technologies')]
class TechnologiesController extends AbstractController
{
    #[Route('/', name: 'technologies_index', methods: ['GET'])]
    public function index(TechnologiesRepository $technologiesRepository): Response
    {
        return $this->render('technologies/index.html.twig', [
            'technologies' => $technologiesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'technologies_new', methods: ['GET', 'POST'])]
    public function new(Request $request,SluggerInterface $slugger): Response
    {
        $technology = new Technologies();
        $form = $this->createForm(TechnologiesType::class, $technology);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageTechnologie = $form->get('imageTechnologie')->getData();

if ($imageTechnologie) {
$originalFilename = pathinfo($imageTechnologie->getClientOriginalName(),PATHINFO_FILENAME);

$safeFilename = $slugger->slug($originalFilename);
$newFilename = $safeFilename.'-'.uniqid().'.'.$imageTechnologie->guessExtension();

try {
    $imageTechnologie->move(
    $this->getParameter('photos_directory'),
    $newFilename
    );
    } catch (FileException $e) {

    }
    $technology->setimageTechnologie($newFilename);
}

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($technology);
            $entityManager->flush();

            return $this->redirectToRoute('technologies_index');
        }

        return $this->render('technologies/new.html.twig', [
            'technology' => $technology,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'technologies_show', methods: ['GET'])]
    public function show(Technologies $technology): Response
    {
        return $this->render('technologies/show.html.twig', [
            'technology' => $technology,
        ]);
    }

    #[Route('/{id}/edit', name: 'technologies_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SluggerInterface $slugger): Response
    {
        $technology = new Technologies();
        $form = $this->createForm(TechnologiesType::class, $technology);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {  $imageTechnologie = $form->get('imageTechnologie')->getData();

            if ($imageTechnologie) {
            $originalFilename = pathinfo($imageTechnologie->getClientOriginalName(),PATHINFO_FILENAME);
            
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$imageTechnologie->guessExtension();
            
            try {
                $imageTechnologie->move(
                $this->getParameter('photos_directory'),
                $newFilename
                );
                } catch (FileException $e) {
            
                }
                $technology->setimageTechnologie($newFilename);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('technologies_index');
        }

        return $this->render('technologies/edit.html.twig', [
            'technology' => $technology,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'technologies_delete', methods: ['POST'])]
    public function delete(Request $request, Technologies $technology): Response
    {
        if ($this->isCsrfTokenValid('delete'.$technology->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($technology);
            $entityManager->flush();
        }

        return $this->redirectToRoute('technologies_index');
    }
}
