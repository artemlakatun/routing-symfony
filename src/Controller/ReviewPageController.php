<?php

namespace App\Controller;

use App\Form\ReviewFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Reviews;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ReviewPageController extends AbstractController {

    #[Route('/review', name: 'app_review_page')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $review = new Reviews();
        $form = $this->createForm(ReviewFormType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($review);
            $entityManager->flush();

            return new RedirectResponse($this->generateUrl('home_page'));
        }



        return $this->render('review_page/index.html.twig', [
            'controller_name' => 'ReviewPageController',
            'form' => $form->createView(),
        ]);
    }
}
