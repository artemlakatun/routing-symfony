<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class MyService {
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws \Exception
     */
    public function promoteToSuperAdmin($userId)
    {
        // Находим пользователя в базе данных по его ID
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->find($userId);

        // Проверяем, найден ли пользователь
        if (!$user) {
            throw new \Exception('User not found');
        }

        // Присваиваем пользователю роль super_admin, если она еще не присвоена
        $roles = $user->getRoles();
        if (!in_array('ROLE_SUPER_ADMIN', $roles)) {
            $roles[] = 'ROLE_SUPER_ADMIN';
            $user->setRoles($roles);

            // Сохраняем изменения в базе данных
            $this->entityManager->flush();
        }
    }
}