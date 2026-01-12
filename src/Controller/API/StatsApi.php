<?php

namespace App\Controller\API;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class StatsApi extends AbstractController
{
    #[Route('/api/stats', methods: ['GET'])]
    public function stats(EntityManagerInterface $em): JsonResponse
    {
        $conn = $em->getConnection();

        $rdvByStatus = $conn->fetchAllAssociative("
            SELECT statut, COUNT(*) as total
            FROM rendez_vous
            GROUP BY statut
        ");

        return $this->json([
            'rdvByStatus' => $rdvByStatus
        ]);
    }
}