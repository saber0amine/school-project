<?php

namespace App\Entity;

use App\Repository\HospitalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HospitalRepository::class)]
class Hospital
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 67)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $adresse = null;

    #[ORM\Column(length: 50)]
    private ?string $ville = null;

    /**
     * @var Collection<int, Medecin>
     */
    #[ORM\OneToMany(targetEntity: Medecin::class, mappedBy: 'hospital')]
    private Collection $medecin;

    public function __construct()
    {
        $this->medecin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Medecin>
     */
    public function getMedecin(): Collection
    {
        return $this->medecin;
    }

    public function addMedecin(Medecin $medecin): static
    {
        if (!$this->medecin->contains($medecin)) {
            $this->medecin->add($medecin);
            $medecin->setHospital($this);
        }

        return $this;
    }

    public function removeMedecin(Medecin $medecin): static
    {
        if ($this->medecin->removeElement($medecin)) {
            // set the owning side to null (unless already changed)
            if ($medecin->getHospital() === $this) {
                $medecin->setHospital(null);
            }
        }

        return $this;
    }
}
