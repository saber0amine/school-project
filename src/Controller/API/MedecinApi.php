<?php

namespace App\Controller\Api;

use App\Entity\Medecin;
use App\Repository\MedecinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MedecinApiController extends AbstractController
{
    #[Route('/api/medecins', methods: ['GET'])]
    public function index(MedecinRepository $repo): JsonResponse
    {
        return $this->json($repo->findAll());
    }

    #[Route('/api/medecins', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $medecin = new Medecin();
        $medecin->setNom($data['nom']);
        $medecin->setSpecialite($data['specialite']);

        $em->persist($medecin);
        $em->flush();

        return $this->json($medecin, 201);
    }

    #[Route('/api/medecins/{id}', methods: ['DELETE'])]
    public function delete(Medecin $medecin, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($medecin);
        $em->flush();

        return $this->json(['message' => 'Doctor deleted']);
    }
}
