<?php
namespace App\Entity;

class Garant
{
	private ?int $id;
	private ?string $nom;
    private ?string $prenom;
    private ?string $rue;

	public function __construct(?int $id = null,?string $nom = null,?string $prenom = null,?string $rue = null)
	{
		$this->id = $id;
		$this->nom = $nom;
        $this->prenom = $prenom;
        $this->rue = $rue;
	}
	public function getId(): int
	{
		return $this->id;
	}
	public function setId($id): void
	{
		$this->id = $id;
	}
	public function getNom(): string
	{
		return $this->nom;
	}
	public function setNom($nom): void
	{
		$this->nom = $nom;
	}
    public function getPrenom(): string
	{
		return $this->prenom;
	}
	public function setPrenom($prenom): void
	{
		$this->prenom = $prenom;
	}
    public function getRue(): string
	{
		return $this->rue;
	}
	public function setRue($rue): void
	{
		$this->rue = $rue;
	}
}
