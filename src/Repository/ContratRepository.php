<?php
namespace App\Repository;

use PDO;
use DateTime;
use PDOEXCEPTION;
use App\Entity\Garant;
use App\Entity\Contrat;
use App\Entity\Locataire;
use App\Entity\Appartement;
use App\Repository\Repository;
use App\Entity\TypeAppartement;



//class dont on a

class ContratRepository extends Repository
{

    public function ajoutContrat(Contrat $contratACreer)
    {
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("insert into immo_contrat 
            values (0,:par_id,:par_debut,:par_fin,:par_montantCharge,:par_montantCaution,:par_montantLoyerHc,:par_salaireLocataire,:par_leLocataire,:par_leGarant,:par_lAppartement)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            
            $req->bindValue(':par_id', $contratACreer->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_debut', $contratACreer->getDebut()->format('Y-m-d'), PDO::PARAM_STR);
            $req->bindValue(':par_fin', $contratACreer->getFin()->format('Y-m-d'), PDO::PARAM_STR);
            $req->bindValue(':par_montantCharge', $contratACreer->getMontantCharge(), PDO::PARAM_INT);
            $req->bindValue(':par_montantCaution', $contratACreer->getMontantCaution(), PDO::PARAM_INT);
            $req->bindValue(':par_montantLoyerHc', $contratACreer->getMontantLoyerHc(), PDO::PARAM_INT);
            $req->bindValue(':par_salaireLocataire', $contratACreer->getSalaireLocataire(), PDO::PARAM_STR);
            $req->bindValue(':par_leLocataire', $contratACreer->getLeLocataire()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_leGarant', $contratACreer->getLeGarant()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_lAppartement', $contratACreer->getLAppartement()->getId(), PDO::PARAM_INT);
    
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }
//    public function getLesContrat(): array
//{
//    // On crée le tableau qui contiendra la liste des contrats
//    $lesContrats = array();
//
//    // On récupère l'objet qui permet de travailler avec la base de données
//    $db = $this->dbConnect();
//
//    $req = $db->prepare("SELECT contrat.id AS id,
//                            contrat.debut,
//                            contrat.fin,
//                            contrat.montant_charge,
//                            contrat.montant_caution,
//                            contrat.montant_loyer_hc,
//                            contrat.salaire_locataire,
//                            locataire.id AS locataire_id,
//                            garant.id AS garant_id,
//                            appartement.id AS appartement_id
//                        FROM contrat
//                        JOIN locataire ON locataire.id = contrat.le_locataire
//                        JOIN garant ON garant.id = contrat.le_garant
//                        JOIN appartement ON appartement.id = contrat.l_appartement");
//
//    // On demande l'exécution de la requête
//    $req->execute();
//
//    $lesEnregs = $req->fetchAll();
//
//    foreach ($lesEnregs as $enreg) {
//        // On crée une instance de Contrat en utilisant les données de chaque enregistrement
//        $contrat = new Contrat(
//            $enreg->id,
//            new DateTime($enreg->debut),
//            new DateTime($enreg['fin']),
//            $enreg->montant_charge,
//            $enreg->montant_caution,
//            $enreg->montant_loyer_hc,
//            $enreg->salaire_locataire,
//            new Locataire($enreg['locataire_id'], null),
//            new Garant($enreg['garant_id'], null),
//            new Appartement($enreg['appartement_id'], null)
//        );
//
//        // On ajoute l'instance de Contrat dans la liste
//        array_push($lesContrats, $contrat);
//    }
//
//    return $lesContrats;
//}
}
