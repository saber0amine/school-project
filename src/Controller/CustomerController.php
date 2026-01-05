<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Customer;

final class CustomerController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    #[Route('/customer', name: 'app_customer')]
    public function show_home(): Response
    {
        return $this->render('customer/index.html.twig', []);
    }
    #[Route('/customers', name: 'listcustomers')]
    public function showCustomers(EntityManagerInterface $entityManager): Response
    {
        return $this->redirectToRoute('app_home');
    }

    // src/Controller/RendezvousController.php
#[Route('/rendezvous', name: 'app_rendezvous')]
public function rendezvous(): Response
{
    return $this->render('customer/rendezvous.php');
}
}