<?php

namespace App\Controller;

use App\Entity\Thanks;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ThanksController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    #[Route('/', name: 'app_thanks')]
    public function index(): Response
    {
        $thanks = $this->entityManager->getRepository(Thanks::class)->findAll();
        
        return $this->render('thanks/index.html.twig', [
            'thanks' => $thanks,
        ]);
    }
}
