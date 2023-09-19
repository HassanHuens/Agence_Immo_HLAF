<?php
namespace App\Repository;

use PDO;
use PDOEXCEPTION;
use App\Entity\Appartement;
use App\Repository\Repository;
use App\Entity\TypeAppartement;



//class dont on a besoin (classe Repository.php obligatoire)

class AppartementRepository extends Repository
{

    public function ajoutAppartement(Appartement $appartACreer)
    {
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("insert into immo_appartement 
            values (0,:par_superficie,:par_orientation,:par_id_type_appart)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_superficie', $appartACreer->getSuperficie(), PDO::PARAM_STR);
            $req->bindValue(':par_orientation', $appartACreer->getOrientation(), PDO::PARAM_STR);
            $req->bindValue(':par_id_type_appart', $appartACreer->getTypeAppartement()->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }
    public function modifAppartement(Appartement $appartAModifier): bool
    {
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        try {
            // on prépare la requête update
            $req = $db->prepare("update immo_appartement
            set  superficie = :par_superficie,
            orientation = :par_orientation,
            id_type_appartement=:par_id_type_appart
            where id = :par_id_appart");
            // on affecte une valeur au paramètre déclaré dans la requête 
            $req->bindValue(':par_superficie', $appartAModifier->getSuperficie(), PDO::PARAM_STR);
            $req->bindValue(':par_orientation', $appartAModifier->getOrientation(), PDO::PARAM_STR);
            $req->bindValue(':par_id_type_appart', $appartAModifier->getTypeAppartement()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_appart', $appartAModifier->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();

            $ret = true;
        } catch (PDOException $e) {
            $ret = false;
        }

        return $ret;
    }
    public function getLesApparts(): array
    {
        // on crèe le tableau qui contiendra la liste des appartements
        $lesApparts = array();
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        $req = $db->prepare("select immo_appartement.id as id, 
                        immo_type_appart.libelle,superficie, orientation
                        from immo_appartement
                        join immo_type_appart on type_appartement.id = id_type_appartement");
        // on demande l'exécution de la requête 
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            // on crée une instance
            $unAppart = new Appartement(
                $enreg->id,
                $enreg->superficie,
                $enreg->orientation,
                new TypeAppartement(null, $enreg->libelle)
            );
            // on ajout l'instance dans la liste
            array_push($lesApparts, $unAppart);
        }
        return $lesApparts;
    }
    public function getUnAppartement($id): ?Appartement
    {
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        $req = $db->prepare("select appartement.id,superficie, orientation, id_type_appartement
                            from immo_appartement 
                            join immo_type_appart on type_appartement.id = id_type_appartement where appartement.id = :par_id");
        // on affecte une valeur au paramètre déclaré dans la requête 
        $req->bindValue(':par_id', $id, PDO::PARAM_INT);
        // on demande l'exécution de la requête 
        $req->execute();
        $enreg = $req->fetch();
        if ($enreg == false) { // l'appartement n'existe pas 
            return null;
        } else { // l'appartement  existe 
            // on crée une instance
            $unAppart = new Appartement(
                $enreg->id,
                $enreg->superficie,
                $enreg->orientation,
                new TypeAppartement($enreg->id_type_appartement, null)
            );
            return $unAppart;
        }
    }
}
