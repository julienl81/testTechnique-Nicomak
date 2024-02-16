<?php

namespace App\Controller;

use App\Form\ThanksType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ThanksFormController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager) {}
    
    #[Route('/thanks/form', name: 'app_thanks_form')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ThanksType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $thanks = $form->getData();

            $this->entityManager->persist($thanks);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_thanks');
        }
        
        return $this->render('thank_form/index.html.twig', [
            'form' => $form,
        ]);
    }
}
