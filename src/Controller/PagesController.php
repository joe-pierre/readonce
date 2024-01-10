<?php

namespace App\Controller;

use App\Entity\ReadonceMessage;
use App\Form\ReadonceMessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Requirement\Requirement;

class PagesController extends AbstractController
{
    #[Route('/', name: 'app_create_message', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $readonceMessage = new ReadonceMessage;

        // dd((string) $readonceMessage->getUuid());
        
        $form = $this->createForm(ReadonceMessageType::class, $readonceMessage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($readonceMessage);
            $em->flush();

            dd("done");
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
    public function show(Request $request, ReadonceMessage $message): Response
    {
        return $this->render('pages/show.html.twig', compact('message'));
    }
}
