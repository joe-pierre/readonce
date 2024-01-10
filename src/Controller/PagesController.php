<?php

namespace App\Controller;

use App\Entity\ReadonceMessage;
use App\Form\ReadonceMessageType;
use App\Repository\ReadonceMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Requirement\Requirement;

class PagesController extends AbstractController
{
    #[Route('/', name: 'app_create_message', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $em, ReadonceMessageRepository $readonceMessageRepository): Response
    {
        dd((string) $readonceMessageRepository->find(2)->getUuid());

        $readonceMessage = new ReadonceMessage;
        
        $form = $this->createForm(ReadonceMessageType::class, $readonceMessage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($readonceMessage);
            $em->flush();

            $this->addFlash(type: 'success', message: 'Message sent successfully');

            return $this->redirectToRoute(route: 'app_create_message');
        }

        return $this->render('pages/create.html.twig', compact('form'));
    }

    #[Route(
        '/messages/{uuid}', 
        requirements: [
            'uuid' => Requirement::UUID_V7,
        ],
        name: 'app_show_message', 
        methods: ['GET']
    )]
    public function show(string $uuid, ReadonceMessageRepository $readonceMessageRepository, EntityManagerInterface $em): Response
    {
        $message = $readonceMessageRepository->findOneByUuid($uuid);

        if ($message) {
            $em->remove($message);
            $em->flush();
        }

        return $this->render('pages/show.html.twig', compact('message'));
    }
}
