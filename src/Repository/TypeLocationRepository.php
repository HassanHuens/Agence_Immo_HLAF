<?php
// Classe dont on a besoin (classe Repository.php obligatoire)
namespace App\Repository;

use App\Entity\TypeLocation;
use App\Repository\Repository;

class TypeLocationRepository extends Repository
{
    // Méthode permettant d'obtenir tous les types d'appartements
    public function getLesTypes(): array
    {
        // On crée le tableau qui contiendra la liste des types d'appartements
        $lesTypesLocations = array();
        // On récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT * FROM immo_type_location ORDER BY libelle");
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs as $enreg) {
            // On crée une instance
            $unTypeLocation = new TypeLocation(
                $enreg->id,
                $enreg->libelle
            );
            // On ajoute l'instance dans la liste
            array_push($lesTypesLocations, $unTypeLocation);
        }
        return $lesTypesLocations;
    }
    

    // public function ajoutCategLocation(TypeLocation $categLocationACreer):bool
    // {
    //     // On récupère l'objet qui permet de travailler avec la base de données
    //     $db = $this->dbConnect();
    //     try {
    //         // On prépare la requête insert
    //         $req = $db->prepare("INSERT INTO immo_type_location VALUES (0, :par_libelle)");
    //         // On affecte une valeur au paramètre déclaré dans la requête
    //         // Récupération de la date du jour
    //         $req->bindValue(':par_libelle', $categLocationACreer->getLibelle(), PDO::PARAM_STR);
    //         // On demande l'exécution de la requête
    //         $ret = $req->execute();
    //     } catch (PDOException $e) {
    //         var_dump($e->getMessage());
    //         $ret = false;
    //     }
    //     return $ret;
    // }
}