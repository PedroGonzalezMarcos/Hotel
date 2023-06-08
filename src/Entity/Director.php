<?php

namespace App\Entity;

use App\Repository\DirectorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DirectorRepository::class)]
class Director
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $dni = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\OneToOne(mappedBy: 'Director', cascade: ['persist', 'remove'])]
    private ?hotel $hotel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getdni(): ?int
    {
        return $this->dni;
    }

    public function setdni(int $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getHotel(): ?hotel
    {
        return $this->hotel;
    }

    public function setHotel(hotel $hotel): self
    {
        // set the owning side of the relation if necessary
        if ($hotel->getDirector() !== $this) {
            $hotel->setDirector($this);
        }

        $this->hotel = $hotel;

        return $this;
    }
}
