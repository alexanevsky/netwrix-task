<?php

namespace App\Controller;

use App\Entity\Country;
use App\Entity\PartnerLocator;
use App\Entity\State;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api')]
class ApiController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em
    )
    {
    }

    #[Route(path: '/partners', methods: ['GET'])]
    public function partners(): JsonResponse
    {
        $partnersLocators = $this->em->getRepository(PartnerLocator::class)->findAll();

        return $this->json([
            'partners' => $partnersLocators
        ]);
    }

    #[Route(path: '/countries', methods: ['GET'])]
    public function countries(): JsonResponse
    {
        $countries = $this->em->getRepository(Country::class)->findAll();

        return $this->json([
            'countries' => $countries
        ]);
    }

    #[Route(path: '/states', methods: ['GET'])]
    public function states(): JsonResponse
    {
        $states = $this->em->getRepository(State::class)->findAll();

        return $this->json([
            'states' => $states
        ]);
    }
}
