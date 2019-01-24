<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarteRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Carte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Décompte du total de carté fourni par Partie
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * Le nom du contrat choisi en toute lettre pour en faire un résumé de partie
     * @ORM\Column(type="string", length=255)
     */
    private $contrat;

    /**
     * Date de début
     * @ORM\Column(type="datetime")
     */
    private $debutDate;

    /**
     * Date de fin
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $finDate;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $j1Score;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $j2Score;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $j3Score;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $j4Score;

    /**
     * La partie liée au carté en cours
     * @ORM\ManyToOne(targetEntity="App\Entity\Partie", inversedBy="cartes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partie;

    /**
     * @ORM\Column(type="boolean")
     */
    private $brin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estGagnant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\JoueurLocal")
     */
    private $partants;

    /**
     * @ORM\Column(type="integer")
     */
    private $pointsPartants;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contratPartants;

    /**
     * @ORM\Column(type="boolean")
     */
    private $accompagne;
    
    public function __construct(){
        $this->debutDate = new \DateTime();
        $this->brin = false;
        $this->estGagnant = true;
        $this->partants = new ArrayCollection();
        $this->accompagne = false;
    }
    
    /**
     * Permet de renvoyer les points correspondant au contrat choisi ainsi que le nombre de joueur nécessaire pour le réaliser
     *
     * @return array
     */
    public function points(){
        $gagnant = 0;
        $perdant = 0;
        $nbJoueur = 0;
        $score = 0;
        switch($this->contrat) {
            // EMBALLAGE
            case "emb_8":
                $gagnant = $this->partie->getConfig()->getEmb8Pos();
                $perdant = $this->partie->getConfig()->getEmb8Neg();
                $this->setContratPartants("Emballage 8");
                $nbJoueur = 2;    
            break;
            case "emb_9":
                $gagnant = $this->partie->getConfig()->getEmb9Pos();
                $perdant = $this->partie->getConfig()->getEmb9Neg();
                $this->setContratPartants("Emballage 9");
                $nbJoueur = 2;
            break;
            case "emb_10":
                $gagnant = $this->partie->getConfig()->getEmb10Pos();
                $perdant = $this->partie->getConfig()->getEmb10Neg();
                $this->setContratPartants("Emballage 10");
                $nbJoueur = 2;
            break;
            case "emb_11":
                $gagnant = $this->partie->getConfig()->getEmb11Pos();
                $perdant = $this->partie->getConfig()->getEmb11Neg();
                $this->setContratPartants("Emballage 11");
                $nbJoueur = 2;
            break;
            case "emb_12":
                $gagnant = $this->partie->getConfig()->getEmb12Pos();
                $perdant = $this->partie->getConfig()->getEmb12Neg();
                $this->setContratPartants("Emballage 12");
                $nbJoueur = 2;
            break;
            // SOLO
            case "solo_6":
                $gagnant = $this->partie->getConfig()->getSolo6Pos();
                $perdant = $this->partie->getConfig()->getSolo6Neg();
                $this->setContratPartants("Solo 6");
                $nbJoueur = 1;
            break;
            case "solo_7":
                $gagnant = $this->partie->getConfig()->getSolo7Pos();
                $perdant = $this->partie->getConfig()->getSolo7Neg();
                $this->setContratPartants("Solo 7");
                $nbJoueur = 1;
            break;
            case "solo_8":
                $gagnant = $this->partie->getConfig()->getSolo8Pos();
                $perdant = $this->partie->getConfig()->getSolo8Neg();
                $this->setContratPartants("Solo 8");
                $nbJoueur = 1;
            break;
            // Picolissimo, picolo, petite misère
            case "picoli_":
                $gagnant = $this->partie->getConfig()->getPicoliPos();
                $perdant = $this->partie->getConfig()->getPicoliNeg();
                $this->setContratPartants("Picolissimo");
                $nbJoueur = $this->bienAccompagne();
            break; 
            case "picolo_":
                $gagnant = $this->partie->getConfig()->getPicoloPos();
                $perdant = $this->partie->getConfig()->getPicoloNeg();
                $this->setContratPartants("Picolo");
                $nbJoueur = $this->bienAccompagne();
            break; 
            case "pmis_":
                $gagnant = $this->partie->getConfig()->getPmisPos();
                $perdant = $this->partie->getConfig()->getPmisNeg();
                $this->setContratPartants("Petite misère");
                $nbJoueur = $this->bienAccompagne();
            break; 
            // Abondance
            case "abon_9":
                $gagnant = $this->partie->getConfig()->getAbon9Pos();
                $perdant = $this->partie->getConfig()->getAbon9Neg();
                $this->setContratPartants("Abondance 9");
                $nbJoueur = 1;
            break;
            case "abon_10":
                $gagnant = $this->partie->getConfig()->getAbon10Pos();
                $perdant = $this->partie->getConfig()->getAbon10Neg();
                $this->setContratPartants("Abondance 10");
                $nbJoueur = 1;
            break;
            case "abon_11":
                $gagnant = $this->partie->getConfig()->getAbon11Pos();
                $perdant = $this->partie->getConfig()->getAbon11Neg();
                $this->setContratPartants("Abondance 11");
                $nbJoueur = 1;
            break;
            // Abondance sur table
            case "abonst_9":
                $gagnant = $this->partie->getConfig()->getAbonst9Pos();
                $perdant = $this->partie->getConfig()->getAbonst9Neg();
                $this->setContratPartants("Abondance 9 sur table");
                $nbJoueur = 1;
            break;
            case "abonst_10":
                $gagnant = $this->partie->getConfig()->getAbonst10Pos();
                $perdant = $this->partie->getConfig()->getAbonst10Neg();
                $this->setContratPartants("Abondance 10 sur table");
                $nbJoueur = 1;
            break;
            case "abonst_11":
                $gagnant = $this->partie->getConfig()->getAbonst11Pos();
                $perdant = $this->partie->getConfig()->getAbonst11Neg();
                $this->setContratPartants("Abondance 11 sur table");
                $nbJoueur = 1;
            break;
            // Grande misère
            case "gm_is":
                $gagnant = $this->partie->getConfig()->getGmisPos();
                $perdant = $this->partie->getConfig()->getGmisNeg();
                $this->setContratPartants("Grande misère");
                $nbJoueur = 1;
            break;
            case "gm_st":
                $gagnant = $this->partie->getConfig()->getGmstPos();
                $perdant = $this->partie->getConfig()->getGmstNeg();
                $this->setContratPartants("Grande misère sur trou");
                $nbJoueur = 1;
            break;
            case "gm_sta":
                $gagnant = $this->partie->getConfig()->getGmstaPos();
                $perdant = $this->partie->getConfig()->getGmstaNeg();
                $this->setContratPartants("Grande misère sur table");
                $nbJoueur = 1;
            break;
            case "gm_stt":
                $gagnant = $this->partie->getConfig()->getGmsttPos();
                $perdant = $this->partie->getConfig()->getGmsttNeg();
                $this->setContratPartants("Grande misère sur trou sur table");
                $nbJoueur = 1;
            break;
            // Le reste : trou, capot, chelem et solo chelem
            case "trou_":
                $gagnant = $this->partie->getConfig()->getTrou();
                $perdant = $this->partie->getConfig()->getTrou();
                $this->setContratPartants("Trou");
                $nbJoueur = 2;
            break;
            case "capot_":
                $gagnant = $this->partie->getConfig()->getCapot();
                $perdant = $this->partie->getConfig()->getCapot();
                $this->setContratPartants("Capot");
                $nbJoueur = 2;
            break;
            case "ptsm_":
                $gagnant = $this->partie->getConfig()->getPtsm();
                $perdant = $this->partie->getConfig()->getPtsm();
                $this->setContratPartants("Chelem");
                $nbJoueur = 1;
            break;
            case "gdsm_":
                $gagnant = $this->partie->getConfig()->getGdsm();
                $perdant = $this->partie->getConfig()->getGdsm();
                $this->setContratPartants("Solo chelem");
                $nbJoueur = 1;
            break;

        }
        
        // Assignation des points gagnés ou perdus dans une variable unique
        if ($this->getEstGagnant() == true) {
            $score = $gagnant;
        } else {
            $score = -$perdant;
        }
        $this->setPointsPartants($score);
        // Attribution des points aux joueurs partants dans JoueurLocal
        foreach ($this->getPartants() as $joueur){                    
            $joueur->setScore($score);
        }
        return compact('score', 'nbJoueur');
    }

    public function bienAccompagne(){
        if ($this->accompagne == true){
            return 2;
        } else {
            return 1;
        }
    } 

    public function leBrin($i){
        if ($this->brin == true){
            return $i + 1;
        } else {
            return $i;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getContrat(): ?string
    {
        return $this->contrat;
    }

    public function setContrat(string $contrat): self
    {
        $this->contrat = $contrat;

        return $this;
    }

    public function getDebutDate(): ?\DateTimeInterface
    {
        return $this->debutDate;
    }

    public function setDebutDate(\DateTimeInterface $debutDate): self
    {
        $this->debutDate = $debutDate;

        return $this;
    }

    public function getFinDate(): ?\DateTimeInterface
    {
        return $this->finDate;
    }

    public function setFinDate(?\DateTimeInterface $finDate): self
    {
        $this->finDate = $finDate;

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

    public function getJ1Score(): ?int
    {
        return $this->j1Score;
    }

    public function setJ1Score(int $j1Score): self
    {
        $this->j1Score = $j1Score;

        return $this;
    }

    public function getJ2Score(): ?int
    {
        return $this->j2Score;
    }

    public function setJ2Score(int $j2Score): self
    {
        $this->j2Score = $j2Score;

        return $this;
    }

    public function getJ3Score(): ?int
    {
        return $this->j3Score;
    }

    public function setJ3Score(int $j3Score): self
    {
        $this->j3Score = $j3Score;

        return $this;
    }

    public function getJ4Score(): ?int
    {
        return $this->j4Score;
    }

    public function setJ4Score(int $j4Score): self
    {
        $this->j4Score = $j4Score;

        return $this;
    }

    public function getBrin(): ?bool
    {
        return $this->brin;
    }

    public function setBrin(bool $brin): self
    {
        $this->brin = $brin;

        return $this;
    }

    public function getEstGagnant(): ?bool
    {
        return $this->estGagnant;
    }

    public function setEstGagnant(bool $estGagnant): self
    {
        $this->estGagnant = $estGagnant;

        return $this;
    }

    /**
     * @return Collection|JoueurLocal[]
     */
    public function getPartants(): Collection
    {
        return $this->partants;
    }

    public function addPartant(JoueurLocal $partant): self
    {
        if (!$this->partants->contains($partant)) {
            $this->partants[] = $partant;
        }

        return $this;
    }

    public function removePartant(JoueurLocal $partant): self
    {
        if ($this->partants->contains($partant)) {
            $this->partants->removeElement($partant);
        }

        return $this;
    }

    public function getPointsPartants(): ?int
    {
        return $this->pointsPartants;
    }

    public function setPointsPartants(int $pointsPartants): self
    {
        $this->pointsPartants = $pointsPartants;

        return $this;
    }

    public function getContratPartants(): ?string
    {
        return $this->contratPartants;
    }

    public function setContratPartants(string $contratPartants): self
    {
        $this->contratPartants = $contratPartants;

        return $this;
    }

    public function getAccompagne(): ?bool
    {
        return $this->accompagne;
    }

    public function setAccompagne(bool $accompagne): self
    {
        $this->accompagne = $accompagne;

        return $this;
    }

}
