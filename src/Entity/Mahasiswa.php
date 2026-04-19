<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity]
#[ApiResource(operations: [
    new GetCollection(),
    new Get(),
    new Post(),
    new Put(),
    new Patch(),
    new Delete(),
])]
#[ApiFilter(SearchFilter::class, properties: [
    'kelas' => 'exact',
    'kelas.nama' => 'partial',
])]
class Mahasiswa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 20, unique: true, nullable: true)]
    private ?string $nim = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank]
    private string $nama;

    #[ORM\Column(length: 1)]
    #[Assert\Choice(choices: ['L', 'P'])]
    private string $jenisKelamin;

    #[ORM\ManyToOne(targetEntity: Kelas::class, inversedBy: 'mahasiswas')]
    #[ORM\JoinColumn(name: 'id_kelas', nullable: false)]

    private Kelas $kelas;

    #[ORM\ManyToOne(targetEntity: Dosen::class)]
    #[ORM\JoinColumn(name: 'id_dosen_pa', nullable: false)]
    private Dosen $dosenPa;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNim(): ?string
    {
        return $this->nim;
    }

    public function setNim(?string $nim): self
    {
        $this->nim = $nim;

        return $this;
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

    public function getJenisKelamin(): string
    {
        return $this->jenisKelamin;
    }

    public function setJenisKelamin(string $jenisKelamin): self
    {
        $this->jenisKelamin = $jenisKelamin;

        return $this;
    }

    public function getKelas(): Kelas
    {
        return $this->kelas;
    }

    public function setKelas(Kelas $kelas): self
    {
        $this->kelas = $kelas;

        return $this;
    }

    public function getDosenPa(): Dosen
    {
        return $this->dosenPa;
    }

    public function setDosenPa(Dosen $dosen): self
    {
        $this->dosenPa = $dosen;

        return $this;
    }
}
