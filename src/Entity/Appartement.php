<?php
namespace App\Entity;

use App\Entity\Proprietaire;
use App\Entity\TypeAppartement;
use App\Entity\Ville;


class Appartement
{
    private ?int $id;
    private ?string $rue;
    private ?string $batiment;
    private ?int $etage;
    private ?int $superficie;
    private ?string $orientation;
    private ?int $nbPieces;
    private ?TypeAppartement $leTypeAppart;
    private ?Proprietaire $leProprietaire;
    private ?Ville $laVille;

    public function __construct(?int $id = null, ?string $rue = null, ?string $batiment = null, ?int $etage = null, ?int $superficie = null, ?string $orientation = null, ?int $nbPieces = null,?TypeAppartement $leTypeAppart = null,?Proprietaire $leProrietaire = null,?Ville $laVille = null)
    {
        $this->id = $id;
        $this->rue = $rue;
        $this->batiment = $batiment;
        $this->etage = $etage;
        $this->superficie = $superficie;
        $this->orientation = $orientation;
        $this->nbPieces = $nbPieces;
        $this->leTypeAppart = $leTypeAppart;
        $this->leProprietaire=$leProrietaire;
        $this->laVille = $laVille;
    }
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of rue
     */ 
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set the value of rue
     *
     * @return  self
     */ 
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get the value of batiment
     */ 
    public function getBatiment()
    {
        return $this->batiment;
    }

    /**
     * Set the value of batiment
     *
     * @return  self
     */ 
    public function setBatiment($batiment)
    {
        $this->batiment = $batiment;

        return $this;
    }

    /**
     * Get the value of etage
     */ 
    public function getEtage()
    {
        return $this->etage;
    }

    /**
     * Set the value of etage
     *
     * @return  self
     */ 
    public function setEtage($etage)
    {
        $this->etage = $etage;

        return $this;
    }

    /**
     * Get the value of superficie
     */ 
    public function getSuperficie()
    {
        return $this->superficie;
    }

    /**
     * Set the value of superficie
     *
     * @return  self
     */ 
    public function setSuperficie($superficie)
    {
        $this->superficie = $superficie;

        return $this;
    }
    public function getNbPieces()
    {
        return $this->nbPieces;
    }

    /**
     * Set the value of nbPiece
     *
     * @return  self
     */ 
    public function setNbPieces($nbPieces)
    {
        $this->nbPieces = $nbPieces;

        return $this;
    }
    /**
     * Get the value of orientation
     */ 
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * Set the value of orientation
     *
     * @return  self
     */ 
    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;

        return $this;
    }

    /**
     * Get the value of nbPiece
     */ 
    

    /**
     * Get the value of leTypeAppart
     */ 
    public function getLeTypeAppart()
    {
        return $this->leTypeAppart;
    }

    /**
     * Set the value of leTypeAppart
     *
     * @return  self
     */ 
    public function setLeTypeAppart($leTypeAppart)
    {
        $this->leTypeAppart = $leTypeAppart;

        return $this;
    }

    public function getLeProprietaire()
    {
        return $this->leProprietaire;
    }

    /**
     * Set the value of leTypeAppart
     *
     * @return  self
     */ 
    public function setLeProprietaire($leProprietaire)
    {
        $this->leProprietaire = $leProprietaire;

        return $this;
    }

    /**
     * Get the value of leProprio
     */ 
    public function getLaVille()
    {
        return $this->laVille;
    }

    /**
     * Set the value of leTypeAppart
     *
     * @return  self
     */ 
    public function setLaVille($laVille)
    {
        $this->laVille = $laVille;

        return $this;
    }
}