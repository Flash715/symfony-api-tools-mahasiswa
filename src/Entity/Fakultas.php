<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(operations: [
    new GetCollection(),
    new Get(),
    new Post(),
    new Put(),
    new Delete(),
])]
class Fakultas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 100, unique: true)]
    #[Assert\NotBlank]
    private string $nama;

    #[ORM\OneToMany(mappedBy: 'fakultas', targetEntity: Prodi::class)]
    private Collection $prodis;

    public function __construct() {
        $this->prodis = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getNama(): string { return $this->nama; }
    public function setNama(string $nama): self { $this->nama = $nama; return $this; }
    public function getProdis(): Collection { return $this->prodis; }
}