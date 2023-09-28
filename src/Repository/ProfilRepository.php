<?php
namespace App\Repository;

use App\Entity\Profil;
use App\Repository\Repository;

//class dont on a besoin (classe Repository.php obligatoire)


class ProfilRepository extends Repository
{
    //méthode permettant d'obtenir tous les types d'appartements
    public function GetLesProfils(): array
    {
        // on crèe le tableau qui contiendra la liste des types d'appartements
        $lesProfils = array();
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT id, libelle FROM immo_profil order by libelle");
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            // on crée une instance
            $unProfil = new Profil(
                $enreg->id,
                $enreg->libelle,
            );
            // on ajout l'instance dans la liste
            array_push($lesProfils, $unProfil);
        }
        return $lesProfils;
    }
}