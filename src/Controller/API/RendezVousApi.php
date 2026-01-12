<?php

namespace App\Controller\API;

use App\Entity\RendezVous;
use App\Repository\RendezVousRepository;
use App\Repository\MedecinRepository;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RendezVousApi extends AbstractController
{
    #[Route('/api/rdv', methods: ['GET'])]
    public function index(RendezVousRepository $repo): JsonResponse
    {
        return $this->json($repo->findAll());
    }

    #[Route('/api/rdv', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $em,
        MedecinRepository $medRepo,
        PatientRepository $patRepo,
        RendezVousRepository $rdvRepo
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        $medecin = $medRepo->find($data['medecin_id']);
        $patient = $patRepo->find($data['patient_id']);

        $existing = $rdvRepo->findOneBy([
            'medecin' => $medecin,
            'date' => new \DateTime($data['date']),
            'heure' => $data['heure']
        ]);

        if ($existing) {
            return $this->json(
                ['error' => 'This slot is already taken'],
                400
            );
        }

        $rdv = new RendezVous();
        $rdv->setMedecin($medecin);
        $rdv->setPatient($patient);
        $rdv->setDate(new \DateTime($data['date']));
        $rdv->setHeure($data['heure']);
        $rdv->setStatut('en_attente');

        $em->persist($rdv);
        $em->flush();

        return $this->json($rdv, 201);
    }

    #[Route('/api/rdv/{id}', methods: ['DELETE'])]
    public function delete(RendezVous $rdv, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($rdv);
        $em->flush();

        return $this->json(['message' => 'Appointment deleted']);
    }
}