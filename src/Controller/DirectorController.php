<?php

namespace App\Controller;

use App\Entity\Director;
use App\Repository\DirectorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/director', name: 'api_')]
class DirectorController extends AbstractController
{   
    public function __construct(private DirectorRepository $directorRepo)
    {
    }

    #[Route('/', name: 'app_director_show_all', methods: ['get'])]
    public function showAll(): JsonResponse
    {
        $directors = $this->directorRepo->findAll();
        $data = [];

        foreach ($directors as $director) {
            $data[] = [
                'id' => $director->getId(),
                'name' => $director->getNombre(),
                'dni' => $director->getDni(),
            ];
        }

        return $this->json([$data]);
    }

    #[Route('/{id}', name: 'api_director_show', methods:['get'] )]
    public function show(int $id): JsonResponse
    {
        $director = $this->directorRepo->find($id);

        $data =  [
            'id' => $director->getId(),
            'name' => $director->getNombre(),
            'dni' => $director->getDni(),
        ];

        return $this->json([$data]);
    }

    #[Route('/new', name: 'api_director_create', methods:['post'] )]
    public function create(Request $request): JsonResponse
    {
    
        $director = new Director();
        $director->setNombre($request->request->get('nombre'));
        $director->setDni($request->request->get('dni'));

        $this->directorRepo->save($director, true);

        $data =  [
            'id' => $director->getId(),
            'name' => $director->getNombre(),
            'dni' => $director->getDni(),
        ];

        return $this->json([$data]);
    }

    

    #[Route('/{id}/edit', name: 'api_director_update', methods:['put', 'post'])]
    public function edit(Request $request, int $id): JsonResponse
    {
        
        $director = $this->directorRepo->find($id);
        
        $director->setNombre($request->request->get('nombre'));
        $director->setDni($request->request->get('dni'));
        
        $this->directorRepo->save($director, true);

        $data =  [
            'id' => $director->getId(),
            'name' => $director->getNombre(),
            'dni' => $director->getDni(),
        ];

        return $this->json($data);
    }

    #[Route('/{id}', name: 'director_delete', methods:['delete'] )]
    public function delete(int $id): JsonResponse
    {
       $director = $this->directorRepo->find($id)
;        if (!$director) {
            return $this->json('No director found for id ' . $id, 404);
        }

        $this->directorRepo->remove($director, true);

        return $this->json('Deleted a director successfully with id ' . $id);
    }
}


    /*public function index(): JsonResponse
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
  */  