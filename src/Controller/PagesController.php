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
        $readonce = new ReadonceMessage;
        
        $form = $this->createForm(ReadonceMessageType::class, $readonce);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($readonce);
            $em->flush();

            dd($readonce);
        }

        return $this->render('pages/create.html.twig', compact('form'));
    }

    #[Route(
        '/messages/{id}', 
        requirements: [
            'id' => Requirement::POSITIVE_INT
        ],
        name: 'app_show_message', 
        methods: ['GET']
    )]
    public function show(Request $request, ReadonceMessage $message): Response
    {
        return $this->render('pages/show.html.twig', compact('message'));
    }
}
