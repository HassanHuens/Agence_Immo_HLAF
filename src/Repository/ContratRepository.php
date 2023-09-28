<?php
/**
 * Summary of namespace App\Repository
 */
namespace App\Repository;

use App\Entity\Appartement;
use App\Entity\Contrat;
use App\Entity\Garant;
use App\Entity\Locataire;
use App\Entity\TypeLocation;
use App\Repository\Repository;
use DateTime;
use PDO;
use PDOEXCEPTION;

/**
 * Summary of ContratRepository
 */
class ContratRepository extends Repository
{
    /**
     * Summary of ajoutContrat
     * @param Contrat $contratACreer
     * @return bool
     */
    public function ajoutContrat(Contrat $contratACreer)
    {
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("insert into 
                immo_contrat values (
                    0,
                    :par_debut,
                    :par_fin,:par_montantCharge,
                    :par_montantCaution,
                    :par_montantLoyerHc,
                    :par_salaireLocataire,
                    :par_leLocataire,
                    :par_leGarant,
                    :par_lAppartement,
                    :par_leTypeLocation
                )"
            );
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_debut', $contratACreer->getDebut()->format('Y-m-d'), PDO::PARAM_STR);
            $req->bindValue(':par_fin', $contratACreer->getFin()->format('Y-m-d'), PDO::PARAM_STR);
            $req->bindValue(':par_montantCharge', $contratACreer->getMontantCharge(), PDO::PARAM_INT);
            $req->bindValue(':par_montantCaution', $contratACreer->getMontantCaution(), PDO::PARAM_INT);
            $req->bindValue(':par_montantLoyerHc', $contratACreer->getMontantLoyerHc(), PDO::PARAM_INT);
            $req->bindValue(':par_salaireLocataire', $contratACreer->getSalaireLocataire(), PDO::PARAM_INT);
            $req->bindValue(':par_leLocataire', $contratACreer->getLeLocataire()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_leGarant', $contratACreer->getLeGarant()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_lAppartement', $contratACreer->getLAppartement()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_leTypeLocation', $contratACreer->getLeTypeLocation()->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }
    
   /**
    * Summary of getLesContrats
    * @return array
    */
   public function getLesContrats(): array
    {
        // on crée le tableau qui contiendra la liste des contrats
        $lesContrats = [];
        // On récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        // on écrit la requête SQL -> SELECT, qui va chercher le contenu de la table immo_contrat pour créer les contrats
        $req = $db->prepare("SELECT 
            immo_contrat.id AS id,
            immo_contrat.debut,
            immo_contrat.fin,
            immo_contrat.montant_charge,
            immo_contrat.montant_caution,
            immo_contrat.montant_loyer_hc,
            immo_contrat.salaire_locataire,
            immo_locataire.id AS locataire_id,
            immo_garant.id AS garant_id,
            immo_appartement.id AS appartement_id,
            immo_type_location.id AS type_location_id
            FROM immo_contrat
            JOIN immo_locataire ON immo_locataire.id = immo_contrat.id_locataire
            JOIN immo_garant ON immo_garant.id = immo_contrat.id_garant
            JOIN immo_appartement ON immo_appartement.id = immo_contrat.id_appartement
            JOIN immo_type_location ON immo_type_location.id = immo_contrat.id_type_location
        ");
        // on demande l'exécution de la requête
        $req->execute();
        // on récupère les contrats dans la variable "lesEnregs"
        $lesEnregs = $req->fetchAll();
        // on parcours les contrats retournés par la requête 
        foreach ($lesEnregs as $enreg) {
            // on crée une instance de Contrat en utilisant les données de chaque enregistrement
            $contrat = new Contrat(
                $enreg->id,
                new DateTime($enreg->debut),
                new DateTime($enreg->fin),
                $enreg->montant_charge,
                $enreg->montant_caution,
                $enreg->montant_loyer_hc,
                $enreg->salaire_locataire,
                new Locataire($enreg->locataire_id),
                new Garant($enreg->garant_id),
                new Appartement($enreg->appartement_id,null,null,null,null,null,null,null,null,null),
                new TypeLocation($enreg->type_location_id, null)
            );
            // On ajoute l'instance de Contrat dans la liste
            array_push($lesContrats, $contrat);
        }
        // on retourne 
        return $lesContrats;
    }

    // fonction qui permet de retourner un contrat avec son id en paramètre
    /**
     * Summary of getUnContrat
     * @param mixed $id
     * @return Contrat|null
     */
    public function getUnContrat($id): ?Contrat
    {
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        // on écrit la requête SQL -> SELECT, qui va chercher le contenu de la table immo_contrat pour créer un contrat
        $req = $db->prepare("SELECT 
            immo_contrat.id AS id,
            immo_contrat.debut,
            immo_contrat.fin,
            immo_contrat.montant_charge,
            immo_contrat.montant_caution,
            immo_contrat.montant_loyer_hc,
            immo_contrat.salaire_locataire,
            immo_locataire.id AS locataire_id,
            immo_garant.id AS garant_id,
            immo_appartement.id AS appartement_id,
            immo_type_location.id AS type_location_id
            FROM immo_contrat
            JOIN immo_locataire ON immo_locataire.id = immo_contrat.id_locataire
            JOIN immo_garant ON immo_garant.id = immo_contrat.id_garant
            JOIN immo_appartement ON immo_appartement.id = immo_contrat.id_appartement
            JOIN immo_type_location ON immo_type_location.id = immo_contrat.id_type_location
        ");
        // permet de selectionner le contrat souhaiter grace à son id dans la variable "req"
        $req->bindValue(':par_id', $id, PDO::PARAM_INT);
        // execute la requête SQL -> SELECT avec l'id en paramètre
        $req->execute();
        // recupère le contrat dans la variable "enreg"
        $enreg = $req->fetch();
        // si la requête ne retourne rien
        if ($req->rowCount() === 0) {
            // on retourne null à la fonction getUnContrat($id)
            return null;
        // sinon
        } else {
            // on crée une instance de Contrat en utilisant les données de la requête
            $unContrat = new Contrat(
                $enreg->id,
                new DateTime($enreg->debut),
                new DateTime($enreg->fin),
                $enreg->montant_charge,
                $enreg->montant_caution,
                $enreg->montant_loyer_hc,
                $enreg->salaire_locataire,
                new Locataire($enreg->locataire_id),
                new Garant($enreg->garant_id),
                new Appartement($enreg->id_appart,null,null,null,null,null,null,null,null,null),
                new TypeLocation($enreg->type_location_id, null)
            );
        }
        // on retourne le contrat à la fonction getUnContrat($id)
        return $unContrat;
    }

    // fonction qui permet de modifier un contrat avec l'objet contrat en paramètre
    /**
     * Summary of modifContrat
     * @param Contrat $contratAModifier
     * @return bool
     */
    public function modifContrat(Contrat $contratAModifier): bool
    {
        $db = $this->dbConnect();
        try {
            $req = $db->prepare("UPDATE immo_contrat SET 
                debut = :par_debut,
                fin = :par_fin,
                montant_charge = :par_montant_charge,
                montant_caution = :par_montant_caution,
                montant_loyer_hc = :par_montant_loyer_hc,
                salaire_locataire = :par_salaire_locataire,
                id_locataire = :par_id_locataire,
                id_garant = :par_id_garant,
                id_appartement = :par_id_appartement,
                id_type_location = :par_id_type_location
                WHERE immo_contrat.id = :par_id_contrat
            ");
            $req->bindValue(':par_debut', $contratAModifier->getdebut()->format('Y-m-d'), PDO::PARAM_STR);
            $req->bindValue(':par_fin', $contratAModifier->getFin()->format('Y-m-d'), PDO::PARAM_STR);
            $req->bindValue(':par_montant_charge', $contratAModifier->getMontantCharge(), PDO::PARAM_INT);
            $req->bindValue(':par_montant_caution', $contratAModifier->getMontantCaution(), PDO::PARAM_INT);
            $req->bindValue(':par_montant_loyer_hc', $contratAModifier->getMontantLoyerHc(), PDO::PARAM_INT);
            $req->bindValue(':par_salaire_locataire', $contratAModifier->getSalaireLocataire(), PDO::PARAM_INT);
            $req->bindValue(':par_id_locataire', $contratAModifier->getLeLocataire()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_garant', $contratAModifier->getLeGarant()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_appartement', $contratAModifier->getLAppartement()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_type_location', $contratAModifier->getLeTypeLocation()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_contrat', $contratAModifier->getId(), PDO::PARAM_INT);
            $ret = $req->execute();
        } catch (PDOEXCEPTION $e) {
            $ret = false;
        }
        return $ret;
    }





    // fonction qui permet de retourner un contrat avec l'id du type de location en paramètre
    /**
     * Summary of getUnContrat
     * @param mixed $id
     * @return Contrat|null
     */
    public function getLesContratsUnTypeLocation($id): array
    {
        // on crée le tableau qui contiendra la liste des contrats
        $lesContrats = [];
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        // on écrit la requête SQL -> SELECT, qui va chercher le contenu de la table immo_contrat pour créer un contrat
        $req = $db->prepare("SELECT 
            immo_contrat.id AS id,
            immo_contrat.debut,
            immo_contrat.fin,
            immo_contrat.montant_charge,
            immo_contrat.montant_caution,
            immo_contrat.montant_loyer_hc,
            immo_contrat.salaire_locataire,
            immo_locataire.nom AS locataire_nom,
            immo_locataire.prenom AS locataire_prenom,
            immo_garant.nom AS garant_nom,
            immo_garant.prenom AS garant_prenom,
            immo_appartement.id AS appartement_id,
            immo_type_location.id AS type_location_id
            FROM immo_contrat
            JOIN immo_locataire ON immo_locataire.id = immo_contrat.id_locataire
            JOIN immo_garant ON immo_garant.id = immo_contrat.id_garant
            JOIN immo_appartement ON immo_appartement.id = immo_contrat.id_appartement
            JOIN immo_type_location ON immo_type_location.id = immo_contrat.id_type_location
            WHERE immo_type_location.id = :par_id
        ");
        // permet de selectionner le contrat souhaiter grace à son id dans la variable "req"
        $req->bindValue(':par_id', $id, PDO::PARAM_INT);
        // execute la requête SQL -> SELECT avec l'id en paramètre
        $req->execute();
        // recupère le contrat dans la variable "enreg"
        $lesEnregs = $req->fetchAll();
        // si la requête ne retourne rien
        // sinon
        foreach ($lesEnregs as $enreg) {
            // on crée une instance de Contrat en utilisant les données de chaque enregistrement
            $contrat = new Contrat(
                $enreg->id,
                new DateTime($enreg->debut),
                new DateTime($enreg->fin),
                $enreg->montant_charge,
                $enreg->montant_caution,
                $enreg->montant_loyer_hc,
                $enreg->salaire_locataire,
                new Locataire(null, $enreg->locataire_nom, $enreg->locataire_prenom),
                new Garant(null, $enreg->garant_nom, $enreg->garant_prenom),
                new Appartement($enreg->appartement_id)
            );
            // On ajoute l'instance de Contrat dans la liste
            array_push($lesContrats, $contrat);
        }
        // on retourne 
        return $lesContrats;
    }
}
