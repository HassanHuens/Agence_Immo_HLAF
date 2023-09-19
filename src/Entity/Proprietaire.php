<?php
namespace App\Entity;

class Proprietaire
{
	private ?int $id;
    private ?string $nom;
    private ?string $prenom;
    private ?string $rue;
    private ?string $email;
    private ?string $telephone;
    
    private ?GestionProprio $laGestionProprio;
	private ?Ville $laVille;

	public function __construct(?int $id,string $nom,string $prenom,string $rue,string $email,?string $telephone,GestionProprio $laGestionProprio,Ville $laVille)
	{
		$this->id = $id;
		$this->nom = $nom;
        $this->prenom = $prenom;
		$this->rue = $rue;
        $this->email = $email;
        $this->telephone = $telephone;
		$this->laGestionProprio = $laGestionProprio;
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
     * Get the value of laGestionProprio
     */ 
    public function getLaGestionProprio()
    {
        return $this->laGestionProprio;
    }

    /**
     * Set the value of laGestionProprio
     *
     * @return  self
     */ 
    public function setLaGestionProprio($laGestionProprio)
    {
        $this->laGestionProprio = $laGestionProprio;

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
