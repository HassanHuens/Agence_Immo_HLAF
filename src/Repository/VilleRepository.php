<?php
namespace App\Repository;

use PDO;
use PDOException;
use App\Repository\Repository;
use App\Entity\Ville;

class VilleRepository extends Repository
{
    public function getLesVilles(): array
    {
        // on crèe le tableau qui contiendra la liste des appartements
        $lesVilles = array();
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        $req = $db->prepare("select insee, code_postal, nom
                        from immo_ville");
        // on demande l'exécution de la requête 
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            // on crée une instance
            $uneVille = new Ville(
                $enreg->insee,
                $enreg->nom,
                $enreg->code_postal
            );
            // on ajout l'instance dans la liste
            array_push($lesVilles, $uneVille);
        }
        return $lesVilles;
    }
}