<?php

namespace App\Controller;
use App\Entity\Creations;
use App\Form\CreationsType;
use App\Repository\CreationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/creations')]
class CreationsController extends AbstractController
{
    #[Route('/', name: 'creations_index', methods: ['GET'])]
    public function index(CreationsRepository $creationsRepository): Response
    {
        return $this->render('creations/index.html.twig', [
            'creations' => $creationsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'creations_new', methods:  ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $creation = new Creations();
        $form = $this->createForm(CreationsType::class, $creation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageCreation = $form->get('imageCreation')->getData();

            if ($imageCreation) {
                $originalFilename = pathinfo($imageCreation->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageCreation->guessExtension();


                try {
                    $imageCreation->move(
                        $this->getParameter('photos_directory'),$newFilename);
                      
                    
                } catch (FileException $e) {
                }
                $creation->setImageCreation($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($creation);
            $entityManager->flush();

            return $this->redirectToRoute('creations_index');
        }

        return $this->render('creations/new.html.twig', [
            'creations' => $creation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'creations_show', methods: ['GET'])]
    public function show(Creations $creation): Response
    {
        return $this->render('creations/show.html.twig', [
            'creation' => $creation,
        ]);
    }

    #[Route('/{id}/edit', name: 'creations_edit', methods:  ['GET', 'POST'])]
    public function edit(Request $request, SluggerInterface $slugger, Creations $creation): Response
    {
        $creation = new Creations();
        $form = $this->createForm(CreationsType::class, $creation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageCreation = $form->get('imageCreation')->getData();

            if ($imageCreation) {
                $originalFilename = pathinfo($imageCreation->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageCreation->guessExtension();

                try {
                    $imageCreation->move(
                        $this->getParameter('photos_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
            }
            $creation->setImageCreation($newFilename);
        }
            $this->getDoctrine()->getManager()->flush();


        return $this->render('creations/edit.html.twig', [
            'creation' => $creation,
            'form' => $form->createView(),
        ]);
        }



    #[Route('/{id}', name: 'creations_delete', methods: ['POST'])]
    public function delete(Request $request, Creations $creation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $creation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($creation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('creations_index');
    }
}
