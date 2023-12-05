<?php

namespace App\Controller;

use App\Service\DayTwoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\DayOneService;

class AdventOfCodeController extends AbstractController
{
    #[Route('/day-one', name: 'app_advent_of_code')]
    public function dayOne(): Response
    {
        $dayOneService = new DayOneService();
        $foundValue = $dayOneService->dayOneCalculationsPartTwo();

        return new Response($foundValue);
    }

    #[Route('/day-two', name: 'app_advent_of_code')]
    public function dayTwo(): Response
    {
        $dayTwoService = new DayTwoService();
        $foundValue = $dayTwoService->dayTwoCalculationsPartTwo();

        return new Response($foundValue);
    }
}
