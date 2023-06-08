<?php

namespace App\Controller;

use App\Entity\Director;
use App\Repository\DirectorRepository;
use App\Entity\hotel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DirectorController extends AbstractController
{ 
    public function __construct(private DirectorRepository $directorRepo)
    {
    }
    
    #[Route('/director', name: 'app_director')]

    public function index(): JsonResponse
    {

    $director1 = new Director();
    $director1->setDni(358340);
    $director1->setNombre('Paula');
   

    $director2 = new Director();
    $director2->setDni(358341);
    $director2->setNombre('Felipe');
    
    
    $this->directorRepo->save($director1, true);
    $this->directorRepo->save($director2, true);

        return $this->json([
            'message' => 'Directors!',
            'path' => 'src/Controller/DirectorController.php',
        ]);
    }
}
