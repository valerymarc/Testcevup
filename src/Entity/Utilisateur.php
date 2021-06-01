<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity=Achat::class, mappedBy="utilisateur")
     */
    private $achats;

    public function __construct()
    {
        $this->achats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Collection|Achat[]
     */
    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Achat $achat): self
    {
        if (!$this->achats->contains($achat)) {
            $this->achats[] = $achat;
            $achat->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): self
    {
        if ($this->achats->removeElement($achat)) {
            // set the owning side to null (unless already changed)
            if ($achat->getUtilisateur() === $this) {
                $achat->setUtilisateur(null);
            }
        }

        return $this;
    }

    //Ces 3 fonctions permettent de calculer total de point en fonction de la periode 

    public function getTotalPeriode1():?int
    {
        $totalPeriod1 = 0;
        for($i=0; $i<count($this->achats); $i++)
        {
            if($this->achats[$i]->getPeriod() === 1){
                $totalPeriod1 += $this->achats[$i]->getTotalPoint();
            }
        }
        return $totalPeriod1;
    }


    public function getTotalPeriode2():?int
    {
        $totalPeriod2 = 0;
        for($i=0; $i<count($this->achats); $i++)
        {
            if($this->achats[$i]->getPeriod() === 2){
                $totalPeriod2 += $this->achats[$i]->getTotalPoint();
            }
        }
        return $totalPeriod2;
    }


    public function getTotalPeriode3():?int
    {
        $totalPeriod3 = 0;
        for($i=0; $i<count($this->achats); $i++)
        {
            if($this->achats[$i]->getPeriod() === 3){
                $totalPeriod3 += $this->achats[$i]->getTotalPoint();
            }
        }
        return $totalPeriod3;
    }


    public function __toString()
    {
        return (string)$this->id;
    }
}
