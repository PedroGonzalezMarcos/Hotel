<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Repository\HotelRepository;
use App\Entity\Director;
use App\Entity\Room;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HotelController extends AbstractController
{   
    public function __construct(private HotelRepository $hotelRepo, private RoomRepository $roomRepo)
    {
    }
    
    #[Route('/hotel', name: 'app_hotel')]
    public function index(): JsonResponse
    {

    $hotel1 = new Hotel();
    $hotel1->setNombre('El pericales');
    $hotel1->setCity('Elda');
    $hotel1->setAddress('Villa nueva');

    $director1 = new Director();
    $director1->setDni(358340);
    $director1->setNombre('Paula');

    //$director =  $this->hotelRepo->find(1);
    $hotel1->setDirector($director1);
    //$hotel1->setClient('Perico');

    $room1 = new Room();
    $room1->setNumber(223);
    $room1->setLevel(2);
    $room1->setOrientation('Est');

    $hotel1->addRoom($room1);
    
    $hotel2 = new Hotel();
    $hotel2->setNombre('Hotel de la muelte');
    $hotel2->setCity('Petrer');
    $hotel2->setAddress('La replaceta');

    $director2 = new Director();
    $director2->setDni(358341);
    $director2->setNombre('Felipe');

    $hotel2->setDirector($director2);

    $room2 = new Room();
    $room2->setNumber(222);
    $room2->setLevel(1);
    $room2->setOrientation('Oest');

    $hotel2->addRoom($room2);

    
    $this->hotelRepo->save($hotel1, true);
    $this->roomRepo->save($room1, true);
    $this->hotelRepo->save($hotel2, true);
    $this->roomRepo->save($room2, true);

        return $this->json([
            'message' => 'HOTEL LIST!',
            'path' => 'src/Controller/HotelController.php',
        ]);
    }
}
