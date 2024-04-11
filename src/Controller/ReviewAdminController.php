<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ReviewFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Reviews;

class ReviewAdminController extends AbstractController
{
    #[Route('/admin/review', name: 'app_review_admin')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reviews = $entityManager->getRepository(Reviews::class)->findAll();


        return $this->render('review_admin/index.html.twig', [
            'reviews' => $reviews,
            'controller_name' => 'ReviewAdminController',
        ]);
    }
}
