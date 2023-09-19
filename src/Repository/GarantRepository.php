<?php
namespace App\Repository;

use App\Entity\Garant;
use App\Repository\Repository;



//class dont on a
class GarantRepository extends Repository
{
    public function getLesGarant(): array
    {
        // On crée le tableau qui contiendra la liste des garants
        $lesGarants = array();

        // On récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();

        $req = $db->prepare("SELECT id, nom, prenom, rue FROM immo_garant");

        // On demande l'exécution de la requête
        $req->execute();

        $lesEnregs = $req->fetchAll();

        foreach ($lesEnregs as $enreg) {
            // On crée une instance de Garant en utilisant les données de chaque enregistrement
            $garant = new Garant(
                $enreg['id'],
                $enreg['nom'],
                $enreg['prenom'],
                $enreg['rue']
            );

            // On ajoute l'instance de Garant dans la liste
            array_push($lesGarants, $garant);
        }

        return $lesGarants;
    }
}