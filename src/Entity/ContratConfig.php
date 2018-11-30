<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContratConfigRepository")
 */
class ContratConfig
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
    private $titre;

    /**
     * @ORM\Column(type="integer")
     */
    private $emb8Pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $emb8Neg;

    /**
     * @ORM\Column(type="integer")
     */
    private $emb9Pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $emb9Neg;

    /**
     * @ORM\Column(type="integer")
     */
    private $emb10Pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $emb10Neg;

    /**
     * @ORM\Column(type="integer")
     */
    private $emb11Pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $emb11Neg;

    /**
     * @ORM\Column(type="integer")
     */
    private $emb12Pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $emb12Neg;

    /**
     * @ORM\Column(type="integer")
     */
    private $solo6Pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $solo6Neg;

    /**
     * @ORM\Column(type="integer")
     */
    private $solo7Pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $solo7Neg;

    /**
     * @ORM\Column(type="integer")
     */
    private $solo8Pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $solo8Neg;

    /**
     * @ORM\Column(type="integer")
     */
    private $pmisPos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pmisNeg;

    /**
     * @ORM\Column(type="integer")
     */
    private $picoliPos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $picoliNeg;

    /**
     * @ORM\Column(type="integer")
     */
    private $picoloPos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $picoloNeg;

    /**
     * @ORM\Column(type="integer")
     */
    private $abon9Pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $abon9Neg;

    /**
     * @ORM\Column(type="integer")
     */
    private $abon10Pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $abon10Neg;

    /**
     * @ORM\Column(type="integer")
     */
    private $abon11Pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $abon11Neg;

    /**
     * @ORM\Column(type="integer")
     */
    private $abonst9Pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $abonst9Neg;

    /**
     * @ORM\Column(type="integer")
     */
    private $abonst10Pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $abonst10Neg;

    /**
     * @ORM\Column(type="integer")
     */
    private $abonst11Pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $abonst11Neg;

    /**
     * @ORM\Column(type="integer")
     */
    private $gmisPos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gmisNeg;

    /**
     * @ORM\Column(type="integer")
     */
    private $gmstPos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gmstNeg;

    /**
     * @ORM\Column(type="integer")
     */
    private $gmstaPos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gmstaNeg;

    /**
     * @ORM\Column(type="integer")
     */
    private $gmsttPos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gmsttNeg;

    /**
     * @ORM\Column(type="integer")
     */
    private $trou;

    /**
     * @ORM\Column(type="integer")
     */
    private $capot;

    /**
     * @ORM\Column(type="integer")
     */
    private $ptsm;

    /**
     * @ORM\Column(type="integer")
     */
    private $gdsm;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partie", mappedBy="config")
     */
    private $parties;

    public function __construct()
    {
        $this->parties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getEmb8Pos(): ?int
    {
        return $this->emb8Pos;
    }

    public function setEmb8Pos(int $emb8Pos): self
    {
        $this->emb8Pos = $emb8Pos;

        return $this;
    }

    public function getEmb8Neg(): ?int
    {
        return $this->emb8Neg;
    }

    public function setEmb8Neg(?int $emb8Neg): self
    {
        $this->emb8Neg = $emb8Neg;

        return $this;
    }

    public function getEmb9Pos(): ?int
    {
        return $this->emb9Pos;
    }

    public function setEmb9Pos(int $emb9Pos): self
    {
        $this->emb9Pos = $emb9Pos;

        return $this;
    }

    public function getEmb9Neg(): ?int
    {
        return $this->emb9Neg;
    }

    public function setEmb9Neg(?int $emb9Neg): self
    {
        $this->emb9Neg = $emb9Neg;

        return $this;
    }

    public function getEmb10(): ?int
    {
        return $this->emb10;
    }

    public function setEmb10(int $emb10): self
    {
        $this->emb10 = $emb10;

        return $this;
    }

    public function getEmb10Neg(): ?int
    {
        return $this->emb10Neg;
    }

    public function setEmb10Neg(?int $emb10Neg): self
    {
        $this->emb10Neg = $emb10Neg;

        return $this;
    }

    public function getEmb11Pos(): ?int
    {
        return $this->emb11Pos;
    }

    public function setEmb11Pos(int $emb11Pos): self
    {
        $this->emb11Pos = $emb11Pos;

        return $this;
    }

    public function getEmb11Neg(): ?int
    {
        return $this->emb11Neg;
    }

    public function setEmb11Neg(?int $emb11Neg): self
    {
        $this->emb11Neg = $emb11Neg;

        return $this;
    }

    public function getEmb12Pos(): ?int
    {
        return $this->emb12Pos;
    }

    public function setEmb12Pos(int $emb12Pos): self
    {
        $this->emb12Pos = $emb12Pos;

        return $this;
    }

    public function getEmb12Neg(): ?int
    {
        return $this->emb12Neg;
    }

    public function setEmb12Neg(?int $emb12Neg): self
    {
        $this->emb12Neg = $emb12Neg;

        return $this;
    }

    public function getSolo6Pos(): ?int
    {
        return $this->solo6Pos;
    }

    public function setSolo6Pos(int $solo6Pos): self
    {
        $this->solo6Pos = $solo6Pos;

        return $this;
    }

    public function getSolo6Neg(): ?int
    {
        return $this->solo6Neg;
    }

    public function setSolo6Neg(?int $solo6Neg): self
    {
        $this->solo6Neg = $solo6Neg;

        return $this;
    }

    public function getSolo7Pos(): ?int
    {
        return $this->solo7Pos;
    }

    public function setSolo7Pos(int $solo7Pos): self
    {
        $this->solo7Pos = $solo7Pos;

        return $this;
    }

    public function getSolo7Neg(): ?int
    {
        return $this->solo7Neg;
    }

    public function setSolo7Neg(?int $solo7Neg): self
    {
        $this->solo7Neg = $solo7Neg;

        return $this;
    }

    public function getSolo8Pos(): ?int
    {
        return $this->solo8Pos;
    }

    public function setSolo8Pos(int $solo8Pos): self
    {
        $this->solo8Pos = $solo8Pos;

        return $this;
    }

    public function getSolo8(): ?int
    {
        return $this->solo8;
    }

    public function setSolo8(?int $solo8): self
    {
        $this->solo8 = $solo8;

        return $this;
    }

    public function getPmis(): ?int
    {
        return $this->pmis;
    }

    public function setPmis(int $pmis): self
    {
        $this->pmis = $pmis;

        return $this;
    }

    public function getPmisNeg(): ?int
    {
        return $this->pmisNeg;
    }

    public function setPmisNeg(?int $pmisNeg): self
    {
        $this->pmisNeg = $pmisNeg;

        return $this;
    }

    public function getPicoliPos(): ?int
    {
        return $this->picoliPos;
    }

    public function setPicoliPos(int $picoliPos): self
    {
        $this->picoliPos = $picoliPos;

        return $this;
    }

    public function getPicoliNeg(): ?int
    {
        return $this->picoliNeg;
    }

    public function setPicoliNeg(?int $picoliNeg): self
    {
        $this->picoliNeg = $picoliNeg;

        return $this;
    }

    public function getPicoloPos(): ?int
    {
        return $this->picoloPos;
    }

    public function setPicoloPos(int $picoloPos): self
    {
        $this->picoloPos = $picoloPos;

        return $this;
    }

    public function getPicoloNeg(): ?int
    {
        return $this->picoloNeg;
    }

    public function setPicoloNeg(?int $picoloNeg): self
    {
        $this->picoloNeg = $picoloNeg;

        return $this;
    }

    public function getAbon9Pos(): ?int
    {
        return $this->abon9Pos;
    }

    public function setAbon9Pos(int $abon9Pos): self
    {
        $this->abon9Pos = $abon9Pos;

        return $this;
    }

    public function getAbon9Neg(): ?int
    {
        return $this->abon9Neg;
    }

    public function setAbon9Neg(?int $abon9Neg): self
    {
        $this->abon9Neg = $abon9Neg;

        return $this;
    }

    public function getAbon10Pos(): ?int
    {
        return $this->abon10Pos;
    }

    public function setAbon10Pos(int $abon10Pos): self
    {
        $this->abon10Pos = $abon10Pos;

        return $this;
    }

    public function getAbon10Neg(): ?int
    {
        return $this->abon10Neg;
    }

    public function setAbon10Neg(?int $abon10Neg): self
    {
        $this->abon10Neg = $abon10Neg;

        return $this;
    }

    public function getAbon11Pos(): ?int
    {
        return $this->abon11Pos;
    }

    public function setAbon11Pos(int $abon11Pos): self
    {
        $this->abon11Pos = $abon11Pos;

        return $this;
    }

    public function getAbon11Neg(): ?int
    {
        return $this->abon11Neg;
    }

    public function setAbon11Neg(?int $abon11Neg): self
    {
        $this->abon11Neg = $abon11Neg;

        return $this;
    }

    public function getAbonst9Pos(): ?int
    {
        return $this->abonst9Pos;
    }

    public function setAbonst9Pos(int $abonst9Pos): self
    {
        $this->abonst9Pos = $abonst9Pos;

        return $this;
    }

    public function getAbonst9Neg(): ?int
    {
        return $this->abonst9Neg;
    }

    public function setAbonst9Neg(?int $abonst9Neg): self
    {
        $this->abonst9Neg = $abonst9Neg;

        return $this;
    }

    public function getAbonst10Pos(): ?int
    {
        return $this->abonst10Pos;
    }

    public function setAbonst10Pos(int $abonst10Pos): self
    {
        $this->abonst10Pos = $abonst10Pos;

        return $this;
    }

    public function getAbonst10Neg(): ?int
    {
        return $this->abonst10Neg;
    }

    public function setAbonst10Neg(?int $abonst10Neg): self
    {
        $this->abonst10Neg = $abonst10Neg;

        return $this;
    }

    public function getAbonst11Pos(): ?int
    {
        return $this->abonst11Pos;
    }

    public function setAbonst11Pos(int $abonst11Pos): self
    {
        $this->abonst11Pos = $abonst11Pos;

        return $this;
    }

    public function getAbonst11Neg(): ?int
    {
        return $this->abonst11Neg;
    }

    public function setAbonst11Neg(?int $abonst11Neg): self
    {
        $this->abonst11Neg = $abonst11Neg;

        return $this;
    }

    public function getGmis(): ?int
    {
        return $this->gmis;
    }

    public function setGmis(int $gmis): self
    {
        $this->gmis = $gmis;

        return $this;
    }

    public function getGmisNeg(): ?int
    {
        return $this->gmisNeg;
    }

    public function setGmisNeg(?int $gmisNeg): self
    {
        $this->gmisNeg = $gmisNeg;

        return $this;
    }

    public function getGmstPos(): ?int
    {
        return $this->gmstPos;
    }

    public function setGmstPos(int $gmstPos): self
    {
        $this->gmstPos = $gmstPos;

        return $this;
    }

    public function getGmstNeg(): ?int
    {
        return $this->gmstNeg;
    }

    public function setGmstNeg(?int $gmstNeg): self
    {
        $this->gmstNeg = $gmstNeg;

        return $this;
    }

    public function getGmstaPos(): ?int
    {
        return $this->gmstaPos;
    }

    public function setGmstaPos(int $gmstaPos): self
    {
        $this->gmstaPos = $gmstaPos;

        return $this;
    }

    public function getGmstaNeg(): ?int
    {
        return $this->gmstaNeg;
    }

    public function setGmstaNeg(?int $gmstaNeg): self
    {
        $this->gmstaNeg = $gmstaNeg;

        return $this;
    }

    public function getGmsttPos(): ?int
    {
        return $this->gmsttPos;
    }

    public function setGmsttPos(int $gmsttPos): self
    {
        $this->gmsttPos = $gmsttPos;

        return $this;
    }

    public function getGmsttNeg(): ?int
    {
        return $this->gmsttNeg;
    }

    public function setGmsttNeg(?int $gmsttNeg): self
    {
        $this->gmsttNeg = $gmsttNeg;

        return $this;
    }

    public function getTrou(): ?int
    {
        return $this->trou;
    }

    public function setTrou(int $trou): self
    {
        $this->trou = $trou;

        return $this;
    }

    public function getCapot(): ?int
    {
        return $this->capot;
    }

    public function setCapot(int $capot): self
    {
        $this->capot = $capot;

        return $this;
    }

    public function getPtsm(): ?int
    {
        return $this->ptsm;
    }

    public function setPtsm(int $ptsm): self
    {
        $this->ptsm = $ptsm;

        return $this;
    }

    public function getGdsm(): ?int
    {
        return $this->gdsm;
    }

    public function setGdsm(int $gdsm): self
    {
        $this->gdsm = $gdsm;

        return $this;
    }

    /**
     * @return Collection|Partie[]
     */
    public function getParties(): Collection
    {
        return $this->parties;
    }

    public function addParty(Partie $party): self
    {
        if (!$this->parties->contains($party)) {
            $this->parties[] = $party;
            $party->setConfig($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): self
    {
        if ($this->parties->contains($party)) {
            $this->parties->removeElement($party);
            // set the owning side to null (unless already changed)
            if ($party->getConfig() === $this) {
                $party->setConfig(null);
            }
        }

        return $this;
    }

    public function getEmb10Pos(): ?int
    {
        return $this->emb10Pos;
    }

    public function setEmb10Pos(int $emb10Pos): self
    {
        $this->emb10Pos = $emb10Pos;

        return $this;
    }

    public function getSolo8Neg(): ?int
    {
        return $this->solo8Neg;
    }

    public function setSolo8Neg(?int $solo8Neg): self
    {
        $this->solo8Neg = $solo8Neg;

        return $this;
    }

    public function getPmisPos(): ?int
    {
        return $this->pmisPos;
    }

    public function setPmisPos(int $pmisPos): self
    {
        $this->pmisPos = $pmisPos;

        return $this;
    }

    public function getGmisPos(): ?int
    {
        return $this->gmisPos;
    }

    public function setGmisPos(int $gmisPos): self
    {
        $this->gmisPos = $gmisPos;

        return $this;
    }
}
