<?php

namespace App\Entity;



use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AchatRepository::class)
 */
class Achat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $produit1;

    /**
     * @ORM\Column(type="integer")
     */
    private $produit2;

    /**
     * @ORM\Column(type="integer")
     */
    private $produit3;

    /**
     * @ORM\Column(type="integer")
     */
    private $produit4;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="achats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit1(): ?int
    {
        return $this->produit1;
    }

    public function setProduit1(int $produit1): self
    {
        $this->produit1 = $produit1;

        return $this;
    }

    public function getProduit2(): ?int
    {
        return $this->produit2;
    }

    public function setProduit2(int $produit2): self
    {
        $this->produit2 = $produit2;

        return $this;
    }

    public function getProduit3(): ?int
    {
        return $this->produit3;
    }

    public function setProduit3(int $produit3): self
    {
        $this->produit3 = $produit3;

        return $this;
    }

    public function getProduit4(): ?int
    {
        return $this->produit4;
    }

    public function setProduit4(int $produit4): self
    {
        $this->produit4 = $produit4;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    //Calcul du nombre de point par produit
    //Pas de nombre negatif dans les produits


    /**
     * Nombre de point produit 1
     *
     * @return integer|null
     */
    public function getPointProd1():?int
    {
        return $this->produit1 <= 0 ? 0 : $this->produit1 * 5;
    }

    /**
     * Nombre de points Produit 2
     *
     * @return int|null
     */
    public function getPointProd2():?int
    {
        //Verifier si au moins un produit 1 est vendu afin de dettminer 
        //le nombre de point du produit 2

        return $this->produit1<=0 ? 0 : ($this->produit2<=0 ? 0 : $this->produit2 * 5);
    }

     /**
      * Nombre de points Produit 3
      *
      * @return int|null
      */
     public function getPointProd3():?int
     {
         //Recuperation de la partie entière de la division du nombre
         //de produit3 par 2
         $paire = (int)($this->produit3 / 2);
         return $this->produit3 <= 0 ? 0 : $paire * 15;
     }

     
     /**
      * Nombre de points Produit 4
      *
      * @return int|null
      */
     public function getPointProd4():?int
     {        
        return $this->produit4 <= 0 ? 0 : $this->produit4 * 35;
     }


     //Calcul du nombre total des point de cet achat
     public function getTotalPoint():?int
     {
         return $this->getPointProd1()+$this->getPointProd2()+$this->getPointProd3()+$this->getPointProd4();
     }


     //Verification de la periode d'achat en fonction de la date d'achat renseigné
     public function getPeriod():?int
     {
        //Conversion de la date en string pour effectuer la comparaison 
        $mydate = $this->createdAt->format('Y-m-d');
        
        if($mydate >= "2021-01-01" && $mydate <= "2021-04-30"){
            return 1;
        }else if($mydate >= "2021-05-01" && $mydate <= "2021-08-31"){
            return 2;
        }else if($mydate >= "2021-09-01" && $mydate <= "2021-12-31"){
            return 3;
        }
     }
     
}
