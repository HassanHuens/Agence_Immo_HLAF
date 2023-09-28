<?php
namespace App\Repository;
use App\Entity\Locataire;
use App\Entity\Ville;
use App\Entity\Impression;
use App\Entity\CategorieSocioprofessionnelle;
use PDO;
use PDOException;

class LocataireRepository extends Repository
{
    public function ajoutLocataire(Locataire $locataireACreer): bool
    {
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        try {
            $req = $db->prepare("insert into immo_locataire
            values (0,
            :par_nom,
            :par_prenom,
            :par_email,
            :par_telephone,
            :par_rue,
            :par_id_impression,
            :par_id_categSocioPro,
            :par_insee_ville
            )");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_nom', $locataireACreer->getNom(), PDO::PARAM_STR);
            $req->bindValue(':par_prenom', $locataireACreer->getPrenom(), PDO::PARAM_STR);
            $req->bindValue(':par_email', $locataireACreer->getEmail(), PDO::PARAM_STR);
            $req->bindValue(':par_telephone', $locataireACreer->getTelephone(), PDO::PARAM_STR);
            $req->bindValue(':par_rue', $locataireACreer->getRue(), PDO::PARAM_STR);
            $req->bindValue(':par_id_impression', $locataireACreer->getLeImpression()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_categSocioPro', $locataireACreer->getCategorieSocioprofessionnelle()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_insee_ville', $locataireACreer->getVille()->getInsee(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }
    
    public function getLesLocataires(): array
    {
            // on crèe le tableau qui contiendra la liste des profils
            $lesLocataires = array();
            // on récupère l'objet qui permet de travailler avec la base de données
            $db = $this->dbConnect();
            $req = $db->prepare("select immo_locataire.id, immo_locataire.nom,prenom, email, immo_ville.insee,telephone, immo_ville.nom as Villenom, rue, immo_impression.libelle as libImpression, immo_categorie_socioprofessionnelle.libelle as categLib
            from immo_locataire 
            join immo_impression on immo_impression.id = id_impression
            join immo_categorie_socioprofessionnelle on immo_categorie_socioprofessionnelle.id = id_categSocioPro
            join immo_ville on immo_ville.insee = insee_ville");
            // on demande l'exécution de la requête 
            $req->execute();
            $lesEnregs = $req->fetchAll();

    foreach ($lesEnregs as $enreg) {
        // On crée une instance de Locataire en utilisant les données de chaque enregistrement
        $unLocataire = new Locataire(
            $enreg->id,
            $enreg->nom,
            $enreg->prenom,
            $enreg->email,
            $enreg->telephone,
            $enreg->rue,
            new Ville(
                $enreg->insee,
                $enreg->Villenom,
            ),
            new Impression(
                $enreg->id,
                $enreg->libImpression
            ),
            new CategorieSocioprofessionnelle(
                $enreg->id,
                $enreg->categLib
            ),
        );
        // On ajoute l'instance de Locataire dans la liste
        array_push($lesLocataires, $unLocataire);
    }

    return $lesLocataires;
}

    public function modifLocataire(Locataire $locataireAModifier): bool
    {
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        try {
            // on prépare la requête update
            $req = $db->prepare("update immo_locataire
            set 
            nom = :par_nom,
            prenom = :par_prenom,
            email = :par_email,
            telephone = :par_telephone,
            rue = :par_rue,   
            id_impression = :par_id_impression,         
            insee_ville = :par_insee_ville,
            id_categSocioPro = :par_id_categSocioPro
            where immo_locataire.id = :par_id_locataire");
            // on affecte une valeur au paramètre déclaré dans la requête 
            $req->bindValue(':par_id_locataire', $locataireAModifier->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_nom', $locataireAModifier->getNom(), PDO::PARAM_STR);
            $req->bindValue(':par_prenom', $locataireAModifier->getPrenom(), PDO::PARAM_STR);
            $req->bindValue(':par_email', $locataireAModifier->getEmail(), PDO::PARAM_STR);
            $req->bindValue(':par_telephone', $locataireAModifier->getTelephone(), PDO::PARAM_STR);
            $req->bindValue(':par_rue', $locataireAModifier->getRue(), PDO::PARAM_STR);
            $req->bindValue(':par_id_impression', $locataireAModifier->getLeImpression()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_insee_ville', $locataireAModifier->getVille()->getInsee(), PDO::PARAM_INT);
            $req->bindValue(':par_id_categSocioPro', $locataireAModifier->getCategorieSocioprofessionnelle()->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();

            $ret = true;
        } catch (PDOException $e) {
            $ret = false;
        }

        return $ret;
    }
    public function getUnLocataire($id): ?Locataire
    {
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        $req = $db->prepare("select immo_locataire.id, immo_locataire.nom,prenom, email, immo_ville.insee,telephone, immo_ville.nom as Villenom, rue, immo_impression.libelle as libImpression, immo_categorie_socioprofessionnelle.libelle as categLib
        from immo_locataire 
        join immo_impression on immo_impression.id = id_impression
        join immo_categorie_socioprofessionnelle on immo_categorie_socioprofessionnelle.id = id_categSocioPro 
        join immo_ville on immo_ville.insee = insee_ville
        where immo_locataire.id = :par_id
        ");
        // on affecte une valeur au paramètre déclaré dans la requête 
        $req->bindValue(':par_id', $id, PDO::PARAM_INT);
        // on demande l'exécution de la requête 
        $req->execute();
        $enreg = $req->fetch();
        if ($enreg == false) { // l'appartement n'existe pas 
            return null;
        } else { // l'appartement  existe 
            // on crée une instance
            $unLocataire = new Locataire(
                $enreg->id,
                $enreg->nom,
                $enreg->prenom,
                $enreg->email,
                $enreg->telephone,
                $enreg->rue,
                new Ville(
                    $enreg->insee,
                    $enreg->Villenom,
                ),
                new Impression(
                    $enreg->id,
                    $enreg->libImpression
                ),
                new CategorieSocioprofessionnelle(
                    $enreg->id,
                    $enreg->categLib
                )
            );
            return $unLocataire;
        }
    }
    public function supprLocataire(Locataire $locataireASupprimer): bool
    {
        // on récupère l'objet qui permet de travailler avec la base de données
        $db = $this->dbConnect();
        try {
            // on prépare la requête update
            $req = $db->prepare("Delete 
            from immo_locataire
            where immo_locataire.id = :par_id_locataire");
            // on affecte une valeur au paramètre déclaré dans la requête 
            $req->bindValue(':par_id_locataire', $locataireASupprimer->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();

            $ret = true;
        } catch (PDOException $e) {
            $ret = false;
        }

        return $ret;
    }
}
?>