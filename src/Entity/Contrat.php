<?php
namespace App\Entity;

use App\Entity\Appartement;
use App\Entity\Garant;
use App\Entity\Locataire;
use App\Entity\TypeLocation;
use DateTime;

class Contrat
{
	private ?int $id;
    private ?DateTime $debut;
    private ?DateTime $fin;
    private ?int $montantCharge;
	private ?int $montantCaution;
	private ?int $montantLoyerHc;
    private ?int $salaireLocataire;
	private ?Locataire $leLocataire;
	private ?Garant $leGarant;
	private ?Appartement $lAppartement;
	private ?TypeLocation $leTypeLocation;

	public function __construct(?int $id = null,?DateTime $debut = null,?DateTime $fin = null,?int $montantCharge = null,?int $montantCaution = null,?int $montantLoyerHc = null,?int $salaireLocataire = null,?Locataire $leLocataire = null,?Garant $leGarant = null,?Appartement $lAppartement = null, ?TypeLocation $leTypeLocation = null)
	{
		$this->id = $id;
		$this->debut = $debut;
		$this->fin = $fin;
		$this->montantCharge = $montantCharge;
		$this->montantCaution = $montantCaution;
		$this->montantLoyerHc = $montantLoyerHc;
		$this->salaireLocataire = $salaireLocataire;
		$this->leLocataire = $leLocataire;
		$this->leGarant = $leGarant;
		$this->lAppartement = $lAppartement;
		$this->leTypeLocation = $leTypeLocation;
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
     * Get the value of debut
     */ 
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set the value of debut
     *
     * @return  self
     */ 
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get the value of fin
     */ 
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set the value of fin
     *
     * @return  self
     */ 
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get the value of montantCharge
     */ 
    public function getMontantCharge()
    {
        return $this->montantCharge;
    }

    /**
     * Set the value of montantCharge
     *
     * @return  self
     */ 
    public function setMontantCharge($montantCharge)
    {
        $this->montantCharge = $montantCharge;

        return $this;
    }

	/**
	 * Get the value of montantCaution
	 */ 
	public function getMontantCaution()
	{
		return $this->montantCaution;
	}

	/**
	 * Set the value of montantCaution
	 *
	 * @return  self
	 */ 
	public function setMontantCaution($montantCaution)
	{
		$this->montantCaution = $montantCaution;

		return $this;
	}

	/**
	 * Get the value of montantLoyerHc
	 */ 
	public function getMontantLoyerHc()
	{
		return $this->montantLoyerHc;
	}

	/**
	 * Set the value of montantLoyerHc
	 *
	 * @return  self
	 */ 
	public function setMontantLoyerHc($montantLoyerHc)
	{
		$this->montantLoyerHc = $montantLoyerHc;

		return $this;
	}

    /**
     * Get the value of salaireLocataire
     */ 
    public function getSalaireLocataire()
    {
        return $this->salaireLocataire;
    }

    /**
     * Set the value of salaireLocataire
     *
     * @return  self
     */ 
    public function setSalaireLocataire($salaireLocataire)
    {
        $this->salaireLocataire = $salaireLocataire;

        return $this;
    }

	/**
	 * Get the value of leLocataire
	 */ 
	public function getLeLocataire()
	{
		return $this->leLocataire;
	}

	/**
	 * Set the value of leLocataire
	 *
	 * @return  self
	 */ 
	public function setLeLocataire($leLocataire)
	{
		$this->leLocataire = $leLocataire;

		return $this;
	}

	/**
	 * Get the value of leGarant
	 */ 
	public function getLeGarant()
	{
		return $this->leGarant;
	}

	/**
	 * Set the value of leGarant
	 *
	 * @return  self
	 */ 
	public function setLeGarant($leGarant)
	{
		$this->leGarant = $leGarant;

		return $this;
	}

	/**
	 * Get the value of lAppartement
	 */ 
	public function getLAppartement()
	{
		return $this->lAppartement;
	}

	/**
	 * Set the value of lAppartement
	 *
	 * @return  self
	 */ 
	public function setLAppartement($lAppartement)
	{
		$this->lAppartement = $lAppartement;

		return $this;
	}
	
	public function getLeTypeLocation()
	{
		return $this->leTypeLocation;
	}

	/**
	 * Set the value of lAppartement
	 *
	 * @return  self
	 */ 
	public function setLeTypeLocation($leTypeLocation)
	{
		$this->leTypeLocation = $leTypeLocation;

		return $this;
	}
}

