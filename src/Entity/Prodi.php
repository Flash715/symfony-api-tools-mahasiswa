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
class Prodi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    private string $nama;

    #[ORM\Column(length: 10, unique: true)]
    #[Assert\NotBlank]
    private string $kode;

    #[ORM\ManyToOne(targetEntity: Fakultas::class, inversedBy: 'prodis')]
    #[ORM\JoinColumn(name: 'id_fakultas', nullable: false)]
    private Fakultas $fakultas;

    #[ORM\OneToMany(mappedBy: 'prodi', targetEntity: Kelas::class)]
    private Collection $kelas;

    public function __construct()
    {
        $this->kelas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNama(): string
    {
        return $this->nama;
    }
    public function setNama(string $nama): self
    {
        $this->nama = $nama;
        return $this;
    }
    public function getKode(): string
    {
        return $this->kode;
    }
    public function setKode(string $kode): self
    {
        $this->kode = $kode;
        return $this;
    }
    public function getFakultas(): Fakultas
    {
        return $this->fakultas;
    }
    public function setFakultas(Fakultas $fakultas): self
    {
        $this->fakultas = $fakultas;
        return $this;
    }
    public function getKelas(): Collection
    {
        return $this->kelas;
    }
}
