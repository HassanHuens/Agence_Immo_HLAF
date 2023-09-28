<?php
namespace App\Entity;

use App\Entity\Ville;
use App\Entity\Impression;
use App\Entity\CategorieSocioProfessionnelle;


class Locataire
{
	private ?int $id;
    private ?string $nom;
    private ?string $prenom;
    private ?string $email;
    private ?string $telephone;
    private ?string $rue;
    private ?int $salaireMensuel;
    private ?Ville $ville;
	private ?Impression $leImpression;
	private ?CategorieSocioProfessionnelle $leCategorieSocioprofessionnelle;


	public function __construct(?int $id,?string $nom = null,?string $prenom = null,?string $email = null,?string $telephone = null,
    ?string $rue = null, ?Ville $ville = null,?Impression $leImpression = null,?CategorieSocioProfessionnelle $leCategorieSocioprofessionnelle = null)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->email = $email;
		$this->telephone = $telephone;
		$this->rue = $rue;
		$this->ville = $ville;
		$this->leImpression = $leImpression;
        $this->leCategorieSocioprofessionnelle = $leCategorieSocioprofessionnelle;
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
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of telephone
     */ 
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @return  self
     */ 
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

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
	 * Get the value of lImpression
	 */ 
	public function getLeImpression(): ?Impression
	{
		return $this->leImpression;
	}

	/**
	 * Set the value of lImpression
	 *
	 * @return  self
	 */ 
	public function setLeImpression($leImpression)
	{
		$this->leImpression = $leImpression;

		return $this;
	}

	/**
	 * Get the value of laCategSocioPro
	 */ 
	public function getCategorieSocioprofessionnelle(): ?CategorieSocioprofessionnelle
	{
		return $this->leCategorieSocioprofessionnelle;
	}

	/**
	 * Set the value of laCategSocioPro
	 *
	 * @return  self
	 */ 
	public function setCategorieSocioprofessionnelle($leCategorieSocioprofessionnelle): void
	{
		$this->leCategorieSocioprofessionnelle = $leCategorieSocioprofessionnelle;
	}

		/**
		 * Get the value of ville
		 */ 
		public function getVille():?Ville
		{
				return $this->ville;
		}

		/**
		 * Set the value of ville
		 *
		 * @return  self
		 */ 
		public function setVille($ville)
		{
				$this->ville = $ville;

				return $this;
		}
}