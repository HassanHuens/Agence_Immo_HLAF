<?php
namespace App\Repository;

use App\Repository\Repository;
use App\Entity\TypeAppartement;

//class dont on a besoin (classe Repository.php obligatoire)


class TypeAppartementRepository extends Repository
{
    //méthode permettant d'obtenir tous les types d'appartements
    public function getLesTypes(): array
    {
        // on crèe le tableau qui contiendra la liste des types d'appartements
        $lesTypesAppart = array();
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT * FROM immo_type_appart order by libelle");
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            // on crée une instance
            $unTypeAppart = new TypeAppartement(
                $enreg->id,
                $enreg->libelle,
            );
            // on ajout l'instance dans la liste
            array_push($lesTypesAppart, $unTypeAppart);
        }
        return $lesTypesAppart;
    }
}
