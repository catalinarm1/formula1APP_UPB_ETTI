<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    //ruta pentru home
    /**
     * @Route("/", name = "home")
     */
    public function home(): Response
    {
        return $this->render('formula/home.html.twig');
    }

// sezoanele din fiecare an

    /**
     * @Route("/seasons", name = "seasons")
     */
    public function seasons(): Response
    {

        $headers = [
            'x-rapidapi-host' => 'api-formula-1.p.rapidapi.com',
            'x-rapidapi-key' => '5a6f44fa10msh40be2be8d20bc5bp18a190jsnb4478dcbc8f1'
        ];
        $client = new GuzzleClient([
            'headers' => $headers
        ]);

        $r = $client->request('GET', 'https://api-formula-1.p.rapidapi.com/seasons');
        $response = $r->getBody()->getContents();

        return $this->render('formula/season.html.twig', [
            'response' => json_decode($response),
        ]);
    }

//statisticile pentru fiecare sezon de formula 1

    /**
     * @Route("/seasons/year", name = "seasons_year")
     */
    public function seasonsYear(Request $request): Response
    {
        $headers = [
            'x-rapidapi-host' => 'api-formula-1.p.rapidapi.com',
            'x-rapidapi-key' => '5a6f44fa10msh40be2be8d20bc5bp18a190jsnb4478dcbc8f1'
        ];

        $client = new GuzzleClient([
            'headers' => $headers,
        ]);

        $r = $client->request('GET', 'https://api-formula-1.p.rapidapi.com/rankings/drivers?season=' . $request->get('year'));
        $response = $r->getBody()->getContents();

        return $this->render('formula/rankings.html.twig', [
            'response' => json_decode($response, true),
        ]);
    }



//TABEL CU TOATE COMPETITIILE

    /**
     * @Route("/competitions", name = "comps")
     */
    public function getCompetitions(Request $request): Response
    {
        $headers = [
            'x-rapidapi-host' => 'api-formula-1.p.rapidapi.com',
            'x-rapidapi-key' => '5a6f44fa10msh40be2be8d20bc5bp18a190jsnb4478dcbc8f1'
        ];

        $client = new GuzzleClient([
            'headers' => $headers,
        ]);

        $r = $client->request('GET', 'https://api-formula-1.p.rapidapi.com/competitions');
        $response = $r->getBody()->getContents();

        return $this->render('formula/competitions.html.twig', [
            'response' => json_decode($response, true),
        ]);


    }



    //INFORMATII DESPRE TOATE ECHIPELE

    /**
     * @Route("/circuits", name = "cir")
     */
    public function getCircuits(Request $request): Response
    {
        $headers = [
            'x-rapidapi-host' => 'api-formula-1.p.rapidapi.com',
            'x-rapidapi-key' => '5a6f44fa10msh40be2be8d20bc5bp18a190jsnb4478dcbc8f1'
        ];

        $client = new GuzzleClient([
            'headers' => $headers,
        ]);

        $r = $client->request('GET', 'https://api-formula-1.p.rapidapi.com/circuits');
        $response = $r->getBody()->getContents();

        return $this->render('formula/circuits.html.twig', [
            'response' => json_decode($response, true),
        ]);


    }




//INFORMATII DESPRE TOATE ECHIPELE

    /**
     * @Route("/teams", name = "tem")
     */
    public function getTeams(Request $request): Response
    {
        $headers = [
            'x-rapidapi-host' => 'api-formula-1.p.rapidapi.com',
            'x-rapidapi-key' => '5a6f44fa10msh40be2be8d20bc5bp18a190jsnb4478dcbc8f1'
        ];

        $client = new GuzzleClient([
            'headers' => $headers,
        ]);

        $r = $client->request('GET', 'https://api-formula-1.p.rapidapi.com/teams');
        $response = $r->getBody()->getContents();

        return $this->render('formula/teams.html.twig', [
            'response' => json_decode($response, true),
        ]);


    }

}