<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartieRepository")
 */
class Partie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $totCarte;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $resume;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $debut;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fin;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $enCours;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContratConfig", inversedBy="parties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $config;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Carte", mappedBy="partie", orphanRemoval=true)
     */
    private $cartes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\JoueurLocal", mappedBy="partie", orphanRemoval=true)
     */
    private $joueurs;

    public function __construct() {
        $this->debut = new \DateTime();
        $this->enCours = true;
        $this->cartes = new ArrayCollection();
        $this->joueurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotCarte(): ?int
    {
        return $this->totCarte;
    }

    public function setTotCarte(int $totCarte): self
    {
        $this->totCarte = $totCarte;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(?\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getEnCours(): ?bool
    {
        return $this->enCours;
    }

    public function setEnCours(bool $enCours): self
    {
        $this->enCours = $enCours;

        return $this;
    }

    public function getConfig(): ?ContratConfig
    {
        return $this->config;
    }

    public function setConfig(?ContratConfig $config): self
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return Collection|Carte[]
     */
    public function getCartes(): Collection
    {
        return $this->cartes;
    }

    public function addCarte(Carte $carte): self
    {
        if (!$this->cartes->contains($carte)) {
            $this->cartes[] = $carte;
            $carte->setPartie($this);
        }

        return $this;
    }

    public function removeCarte(Carte $carte): self
    {
        if ($this->cartes->contains($carte)) {
            $this->cartes->removeElement($carte);
            // set the owning side to null (unless already changed)
            if ($carte->getPartie() === $this) {
                $carte->setPartie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JoueurLocal[]
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(JoueurLocal $joueur): self
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs[] = $joueur;
            $joueur->setPartie($this);
        }

        return $this;
    }

    public function removeJoueur(JoueurLocal $joueur): self
    {
        if ($this->joueurs->contains($joueur)) {
            $this->joueurs->removeElement($joueur);
            // set the owning side to null (unless already changed)
            if ($joueur->getPartie() === $this) {
                $joueur->setPartie(null);
            }
        }

        return $this;
    }

}
