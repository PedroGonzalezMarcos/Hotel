<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use App\Entity\Hotel;
use App\Repository\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/client', name: 'api_')]
class ClientListController extends AbstractController
{   
    public function __construct(private ClientRepository $clientRepo, private HotelRepository $hotelRepo)
    {
    }

    #[Route('/client/list', name: 'app_client_list')]
    public function index(): JsonResponse
    {
    $client1 = new Client();
    $client1->setDni(658340);
    $client1->setNombre('Perico');
    $client1->setAddress('Vile Street');
    $hotel1 = $this->hotelRepo->find(4);
    $client1->addHotel($hotel1);
    
    $client2 = new Client();
    $client2->setDni(658341);
    $client2->setNombre('Antonio');
    $client2->setAddress('Vile Street');
    $hotel2 = $this->hotelRepo->find(5);
    $client2->addHotel($hotel2);

   
   //$this->hotelRepo->save($hotel1, true);
    $this->clientRepo->save($client1, true);
    
    //$this->hotelRepo->save($hotel2, true);
    $this->clientRepo->save($client2, true);
    
    $client = $this->clientRepo->findOneBy(['nombre' => 'Perico']);

        return $this->json([
            'message' => 'THIS IS THE FUCKING CLIENT LIST!',
            'client' => $client
        ]);
    }

   

    #[Route('/', name: 'app_client_show_all', methods: ['get'])]
    public function showAll(): JsonResponse
    {
        $clients = $this->clientRepo->findAll();
        $data = [];

        foreach ($clients as $client) {
            $data[] = [
                'id' => $client->getId(),
                'Nombre' => $client->getNombre(),
                'dni' => $client->getDni(),
                'adress' =>$client->getAddress()
            ];
        }

        return $this->json($data, 200);
    }

    #[Route('/new', name: 'api_client_create', methods:['post'] )]
    public function create(Request $request): JsonResponse
    {
    
        $client = new Client();
        $client->setNombre($request->request->get('nombre'));
        $client->setDni($request->request->get('dni'));
        $client->setAddress($request->request->get('address'));

        $this->clientRepo->save($client, true);

        $data =  [
            'id' => $client->getId(),
            'Nombre' => $client->getNombre(),
            'dni' => $client->getDni(),
            'adress' =>$client->getAddress()
        ];

        return $this->json([$data]);
    }
}
