<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JoueurLocalRepository")
 * 
 */
class JoueurLocal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $scoreTotal;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partie", inversedBy="joueurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partie;

    public function __construct(){
        $this->scoreTotal = 0;
    }

    public function getPointsSuite($pointCarte, $carte){
        
            if ($pointCarte['nbJoueur'] == 2){
                if ($this->getScore() == 0){
                    $this->setScore(-$pointCarte['score']);
                }
            } else {
                if ($this->getScore() == 0){
                    $divParTrois = -($pointCarte['score'] / 3);
                    $this->setScore($divParTrois);
                }
            }
            // Addition du scoreTotal de chaque joueur
            $this->setScoreTotal($this->getScoreTotal() + $this->getScore());
            // Déplacement des scores de JoueurLocal vers Carte et remise à zero du score temporaire du joueur
            switch ($this->getOrdre()){
                case 1: 
                    $carte->setJ1Score($this->getScoreTotal());
                    $this->setScore(0);
                break;                        
                case 2: 
                    $carte->setJ2Score($this->getScoreTotal());
                    $this->setScore(0);
                break;                        
                case 3: 
                    $carte->setJ3Score($this->getScoreTotal());
                    $this->setScore(0);
                break;                        
                case 4: 
                    $carte->setJ4Score($this->getScoreTotal());
                    $this->setScore(0);
                break;                        
            }
                
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getPartie(): ?Partie
    {
        return $this->partie;
    }

    public function setPartie(?Partie $partie): self
    {
        $this->partie = $partie;

        return $this;
    }

    public function getScoreTotal(): ?int
    {
        return $this->scoreTotal;
    }

    public function setScoreTotal(int $scoreTotal): self
    {
        $this->scoreTotal = $scoreTotal;

        return $this;
    }
}
