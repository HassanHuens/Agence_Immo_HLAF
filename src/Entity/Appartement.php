<?php
namespace App\Entity;

use App\Entity\TypeAppart;

class Appartement
{
	private ?int $id;
	private ?string $rue;
	private ?string $batiment;
	private ?int $etage;
	private ?int $superficie;
	private ?string $orientation;
	private ?int $nbPiece;
	private ?TypeAppart $leTypeAppart;
	private ?Proprietaire $leProprio;
	private ?Ville $laVille;

	public function __construct(?int $id,string $rue,string $batiment,int $etage,int $superficie,string $orientation,int $nbPiece,TypeAppart $leTypeAppart,Proprietaire $leProprio,Ville $laVille)
	{
		$this->id = $id;
		$this->rue = $rue;
		$this->batiment = $batiment;
		$this->etage = $etage;
		$this->superficie = $superficie;
		$this->orientation = $orientation;
		$this->nbPiece = $nbPiece;
		$this->leTypeAppart = $leTypeAppart;
		$this->leProprio = $leProprio;
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
	public function getNbPiece()
	{
		return $this->nbPiece;
	}

	/**
	 * Set the value of nbPiece
	 *
	 * @return  self
	 */ 
	public function setNbPiece($nbPiece)
	{
		$this->nbPiece = $nbPiece;

		return $this;
	}

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

	/**
	 * Get the value of leProprio
	 */ 
	public function getLeProprio()
	{
		return $this->leProprio;
	}

	/**
	 * Set the value of leProprio
	 *
	 * @return  self
	 */ 
	public function setLeProprio($leProprio)
	{
		$this->leProprio = $leProprio;

		return $this;
	}

	/**
	 * Get the value of laVille
	 */ 
	public function getLaVille()
	{
		return $this->laVille;
	}

	/**
	 * Set the value of laVille
	 *
	 * @return  self
	 */ 
	public function setLaVille($laVille)
	{
		$this->laVille = $laVille;

		return $this;
	}
}
