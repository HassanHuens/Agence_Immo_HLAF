<?php
namespace App\Repository;

use App\Entity\GestionProprio;
use PDO;
use PDOException;
use App\Repository\Repository;
use App\Entity\Ville;
use App\Entity\Proprietaire;

class ProprietaireRepository extends Repository
{
    public function getLesProprietaires(): array
    {
        // on crèe le tableau qui contiendra la liste des appartements
        $lesProprietaires = array();
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        $req = $db->prepare("select immo_proprietaire.id, immo_proprietaire.nom as nomProprio,immo_proprietaire.rue,immo_proprietaire.prenom,immo_proprietaire.email,immo_proprietaire.telephone,immo_gestionProprio.libelle,immo_ville.nom
                        from immo_proprietaire
                        JOIN immo_gestionproprio ON id_gestionProprio=immo_gestionproprio.id
                        JOIN immo_ville ON id_ville=immo_ville.insee");
        // on demande l'exécution de la requête 
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            // on crée une instance
            $unProprietaire = new Proprietaire(
                $enreg->id,
                $enreg->nomProprio,
                $enreg->prenom,
                $enreg->rue,
                $enreg->email,
                $enreg->telephone,
                new GestionProprio(null, $enreg->libelle),
                new Ville(null, $enreg->nom,null)
            );
            // on ajout l'instance dans la liste
            array_push($lesProprietaires, $unProprietaire);
        }
        return $lesProprietaires;
    }
}