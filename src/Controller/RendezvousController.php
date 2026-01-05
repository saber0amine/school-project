<?php

// src/Controller/RendezvousController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class RendezvousController extends AbstractController
{
    #[Route('/rendezvous', name: 'app_rendezvous')]
    public function index(Request $request, SessionInterface $session): Response
    {
        $errors = [
            'login' => $session->get('login_error', ''),
            'register' => $session->get('register_error', ''),
        ];
        
        $activeForm = $session->get('active_form', 'login');
        
        // Effacer les messages d'erreur après les avoir récupérés
        $session->remove('login_error');
        $session->remove('register_error');
        $session->remove('active_form');
        
        return $this->render('customer/rendezvous.html.twig', [
            'errors' => $errors,
            'active_form' => $activeForm,
        ]);
    }
}