<?php
namespace App\Entity;

use DateTime;

class TypeAppart
{
	private ?int $id;
    private ?DateTime $dateDebut;
    private ?DateTime $dateFin;
	private ?string $libelle;

	public function __construct($id, $libelle)
	{
		$this->id = $id;
		$this->libelle = $libelle;
	}
	public function getId(): int
	{
		return $this->id;
	}
	public function setId($id): void
	{
		$this->id = $id;
	}
	public function getLibelle(): string
	{
		return $this->libelle;
	}
	public function setLibelle($libelle): void
	{
		$this->libelle = $libelle;
	}
}
