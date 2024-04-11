<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ReviewFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Reviews;
use Symfony\Component\HttpFoundation\Request;

class ReviewAdminController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/review', name: 'app_review_admin')]
    public function index( Request $request): Response
    {
        if ($request->isMethod('POST')) {
            // Получаем данные из POST-запроса
            $id = $request->request->get('id');
            $userName = $request->request->get('userName');
            $subject = $request->request->get('subject');
            $text = $request->request->get('text');
            $evaluation = $request->request->get('evaluation');

            // Находим отзыв в базе данных
            $review = $this->entityManager->getRepository(Reviews::class)->find($id);

            if (!$review) {
                throw $this->createNotFoundException('Review not found');
            }

            // Обновляем данные отзыва
            $review->setUserName($userName);
            $review->setSubject($subject);
            $review->setText($text);
            $review->setEvaluation($evaluation);

            // Сохраняем изменения в базе данных
            $this->entityManager->flush();
        }

        // Получаем все отзывы для отображения на странице
        $reviews = $this->entityManager->getRepository(Reviews::class)->findAll();


        return $this->render('review_admin/index.html.twig', [
            'reviews' => $reviews,
            'controller_name' => 'ReviewAdminController',
        ]);
    }
}
