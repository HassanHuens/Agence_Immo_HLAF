<?php
namespace App\Repository;

use App\Entity\Appartement;
use App\Entity\TypeAppartement;
use App\Entity\Proprietaire;
use App\Entity\Ville;
use App\Repository\Repository;
use PDO;
use PDOException;

class AppartementRepository extends Repository
{

    public function ajoutAppartement(Appartement $appartACreer): bool
    {
        $db = $this->dbConnect();
        try {
            $req = $db->prepare("INSERT INTO immo_appartement
                VALUES
                (0,:par_rue,:par_batiment,:par_etage,:par_superficie,:par_orientation,:par_nb_pieces,:par_id_type_appart,:par_id_proprietaire,:par_id_ville)");
            $req->bindValue(':par_rue', $appartACreer->getRue(), PDO::PARAM_STR);
            $req->bindValue(':par_batiment', $appartACreer->getBatiment(), PDO::PARAM_STR);
            $req->bindValue(':par_etage', $appartACreer->getEtage(), PDO::PARAM_INT);
            $req->bindValue(':par_superficie', $appartACreer->getSuperficie(), PDO::PARAM_INT);
            $req->bindValue(':par_orientation', $appartACreer->getOrientation(), PDO::PARAM_STR);
            $req->bindValue(':par_nb_pieces', $appartACreer->getNbPieces(), PDO::PARAM_INT);
            $req->bindValue(':par_id_type_appart', $appartACreer->getLeTypeAppart()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_proprietaire', $appartACreer->getLeProprietaire()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_ville', $appartACreer->getLaVille()->getInsee(), PDO::PARAM_INT);

            $ret = $req->execute();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            $ret = false;
        }
        return $ret;
    }

    public function modifAppartement(Appartement $appartAModifier): bool
    {
        $db = $this->dbConnect();
        try {
            $req = $db->prepare("UPDATE immo_appartement
                SET immo_appartement.rue = :par_rue,
                immo_appartement.batiment = :par_batiment,
                immo_appartement.etage = :par_etage,
                immo_appartement.superficie = :par_superficie,
                immo_appartement.orientation = :par_orientation,
                id_type_appart = :par_id_type_appart,
                immo_appartement.id_proprietaire = :par_id_proprietaire,
                immo_appartement.id_ville=:par_id_ville
                WHERE immo_appartement.id = :par_id_appart");
            $req->bindValue(':par_rue', $appartAModifier->getRue(), PDO::PARAM_STR);
            $req->bindValue(':par_batiment', $appartAModifier->getBatiment(), PDO::PARAM_STR);
            $req->bindValue(':par_etage', $appartAModifier->getEtage(), PDO::PARAM_INT);
            $req->bindValue(':par_superficie', $appartAModifier->getSuperficie(), PDO::PARAM_INT);
            $req->bindValue(':par_orientation', $appartAModifier->getOrientation(), PDO::PARAM_STR);
            $req->bindValue(':par_id_type_appart', $appartAModifier->getLeTypeAppart()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_proprietaire', $appartAModifier->getLeProprietaire()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_ville', $appartAModifier->getLaVille()->getInsee(), PDO::PARAM_INT);
            $req->bindValue(':par_id_appart', $appartAModifier->getId(), PDO::PARAM_INT);
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }

    public function getLesApparts(): array
    {
        $lesApparts = array();
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT immo_appartement.id,immo_appartement.rue,batiment,etage,superficie,orientation,nb_pieces,
            immo_type_appart.libelle,immo_proprietaire.nom as nomProprio,immo_ville.nom as nomVille
            FROM immo_appartement
            JOIN immo_type_appart ON immo_type_appart.id = id_type_appart
            JOIN immo_proprietaire ON immo_proprietaire.id = id_proprietaire
            JOIN immo_ville ON immo_ville.insee=immo_appartement.id_ville");
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $unAppart = new Appartement(
                $enreg->id,
                $enreg->rue,
                $enreg->batiment,
                $enreg->etage,
                $enreg->superficie,
                $enreg->orientation,
                $enreg->nb_pieces,
                new TypeAppartement
                (null, 
                $enreg->libelle),
                new Proprietaire(null,$enreg->nomProprio,null,null,null,null,null,null),
                new Ville(null, $enreg->nomVille,null)

            );
            
            array_push($lesApparts, $unAppart);
            
        }

        return $lesApparts;
    }

    public function getUnAppartement($id): ?Appartement
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT immo_appartement.id AS idAppart,immo_appartement.rue,batiment,etage,superficie,orientation,nb_pieces,
        immo_type_appart.id as idType,immo_type_appart.libelle as libelleType,immo_proprietaire.id as idProprio,immo_proprietaire.nom as nomProprio,immo_ville.insee as idVille,immo_ville.nom as nomVille
        FROM immo_appartement
        JOIN immo_type_appart ON immo_type_appart.id = immo_appartement.id_type_appart
        JOIN immo_proprietaire ON immo_proprietaire.id=immo_appartement.id_proprietaire
        JOIN immo_ville ON immo_ville.insee=immo_appartement.id_ville 
        WHERE immo_appartement.id = :par_id");
        $req->bindValue(':par_id', $id, PDO::PARAM_INT);
        $req->execute();
        $enreg = $req->fetch();
        if ($req->rowCount() === 0) {
            return null;
        } else {
            $unAppart = new Appartement(
                $enreg->idAppart,
                $enreg->rue,
                $enreg->batiment,
                $enreg->etage,
                $enreg->superficie,
                $enreg->orientation,
                $enreg->nb_pieces,
                new TypeAppartement
                ($enreg->idType,
                $enreg->libelleType),
                new Proprietaire($enreg->idProprio,$enreg->nomProprio,null,null,null,null,null,null),
                new Ville
                ($enreg->idVille,
               $enreg->nomVille,
                null)

            );
            return $unAppart;
        }
    }

    public function getLesAppartsLibres(): array
    {
        $lesAppartsLibres = array();
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT immo_appartement.id,immo_appartement.rue as rueAppart,batiment,etage,superficie,orientation,nb_pieces,immo_type_appart.libelle,immo_proprietaire.nom as nomProprio,immo_ville.nom as nomVille
        FROM immo_appartement 
        JOIN immo_type_appart on id_type_appart=immo_type_appart.id
        JOIN immo_proprietaire ON immo_proprietaire.id = id_proprietaire
        JOIN immo_ville ON immo_ville.insee=immo_appartement.id_ville
        LEFT JOIN immo_contrat  ON immo_appartement.id = immo_contrat.id_appartement
        WHERE immo_contrat.id IS NULL;
        ");
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $unAppart = new Appartement(
                $enreg->id,
                $enreg->rueAppart,
                $enreg->batiment,
                $enreg->etage,
                $enreg->superficie,
                $enreg->orientation,
                $enreg->nb_pieces,
                new TypeAppartement
                (null, 
                $enreg->libelle),
                new Proprietaire(null,$enreg->nomProprio,null,null,null,null,null,null),
                new Ville(null, $enreg->nomVille,null)

            );
            array_push($lesAppartsLibres, $unAppart);
        }
        return $lesAppartsLibres;
    }
    public function getUnAppartementLibre($id): ?Appartement
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT immo_appartement.id,immo_appartement.rue as rueAppart,batiment,etage,superficie,orientation,nb_pieces,immo_type_appart.libelle as libelleType,immo_proprietaire.nom as nomProprio,immo_ville.nom as nomVille
        FROM immo_appartement 
        JOIN immo_type_appart on id_type_appart=immo_type_appart.id
        JOIN immo_proprietaire ON immo_proprietaire.id=immo_appartement.id_proprietaire
        JOIN immo_ville ON immo_ville.insee=immo_appartement.id_ville
        LEFT JOIN immo_contrat  ON immo_appartement.id = immo_contrat.id_appartement
        WHERE immo_contrat.id IS NULL");
        $req->bindValue(':par_id', $id, PDO::PARAM_INT);
        $req->execute();
        $enreg = $req->fetch();
        if ($req->rowCount() === 0) {
            return null;
        } else {
            $unAppartLibre = new Appartement(
                $enreg->id,
                $enreg->rueAppart,
                $enreg->batiment,
                $enreg->etage,
                $enreg->superficie,
                $enreg->orientation,
                $enreg->nb_pieces,
                new TypeAppartement
                ($enreg->id,
                $enreg->libelleType),
                new Proprietaire($enreg->id,$enreg->nomProprio,null,null,null,null,null,null),
                new Ville
                ($enreg->id,
               $enreg->nomVille,
                null)

            );
            return $unAppartLibre;
        }
    }
    public function supprAppartement(Appartement $appartASupprimer): bool
    {
        $db = $this->dbConnect();
        try {
            $req = $db->prepare("DELETE FROM immo_appartement
                WHERE immo_appartement.id = :par_id_appart ");
            $req->bindValue(':par_id_appart', $appartASupprimer->getId(), PDO::PARAM_INT);
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }

}