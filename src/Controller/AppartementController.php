<?php
namespace App\Controller;

use App\Controller\Controller;
use App\Entity\Appartement;
use App\Entity\Proprietaire;
use App\Entity\TypeAppartement;
use App\Entity\Ville;
use App\Repository\AppartementRepository;
use App\Repository\ProprietaireRepository;
use App\Repository\TypeAppartementRepository;
use App\Repository\VilleRepository;

class AppartementController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function ajoutForm(): void
    {
        // il faut demander au modèle la liste des types d'appartements pour alimenter la liste déroulante
        $typeAppartementRepository = new TypeAppartementRepository();
        $lesTypesAppartements = $typeAppartementRepository->getLesTypes();

        $proprietaireRepository = new ProprietaireRepository();
        $lesProprietaires = $proprietaireRepository->getLesProprietaires();

        $villeRepository = new VilleRepository();
        $lesVilles = $villeRepository->getLesVilles();

        // on appelle la vue pour afficher le formulaire d'ajout d'un appartement
        $this->render(ROOT . "/templates/Appartement/ajout", ["title" => "Ajout d'un appartement", "lesTypesAppartements" => $lesTypesAppartements,"lesProprietaires"=>$lesProprietaires,"lesVilles"=>$lesVilles]);
    }
    public function ajoutTrait()
    {
        // on crée une instance de la classe Appartement à partir des données saisies sur le formulaire
        $appart = new Appartement(
            null,
            $_POST['rue'],
            $_POST['batiment'],
            $_POST['etage'],
            $_POST['superficie'],
            $_POST['orientation'],
            $_POST['nb_pieces'],
            new TypeAppartement($_POST['lstTypeAppart'],null),
            new Proprietaire($_POST['lstProprietaires'],null,null,null,null,null,null,null),
            new Ville($_POST['lstVilles'],null,null)
        );
        // on crée une instance de AppartementRepository
        $unAppartRepository = new AppartementRepository();

        // on appelle la méthode qui permet d'ajouter l'appartement
        // ret contient false si l'ajout n'a pas pu avoir lieu (erreur)
        // ret contient true si l'ajout s'est bien passé
        $ret = $unAppartRepository->ajoutAppartement($appart);

        // Réaffichage du formulaire (la vue Appartement/ajout)
        // ----------------------------------------------------
        // pour le formulaire, on récupère les types d'appartement
        // il faut demander au modèle la liste des types d'appartements pour alimenter la liste déroulante
        $typeAppartementRepository = new TypeAppartementRepository();
        $lesTypesAppartements = $typeAppartementRepository->getLesTypes();

        $proprietaireRepository = new ProprietaireRepository();
        $lesProprietaires = $proprietaireRepository->getLesProprietaires();

        $villeRepository = new VilleRepository();
        $lesVilles = $villeRepository->getLesVilles();
        // dans le formulaire, on affiche un message d'erreur ou un message de confirmation de l'ajout
        if ($ret == false) {
            // affichage d'un message d'erreur : l'appartement n'a pas été ajouté on doit réafficher les données saisies (on passe un objet à la vue)
            $msg = "<p class='text-danger'>ERREUR : votre appartement n'a pas été enregistré</p>";
            $this->render(ROOT . "/templates/Appartement/ajout", ["title" => "Ajout d'un appartement", "lesTypesApparts" => $lesTypesAppartements,"lesProprietaires"=>$lesProprietaires,"lesVilles"=>$lesVilles, "msg" => $msg, "lAppart" => $appart]);
        } else {
            // pas de  : l'appartement n'a pas été ajouté
            $msg = "<p class='text-success'>Votre appartement a été enregistré</p>";
            $this->render(ROOT . "/templates/Appartement/ajout", ["title" => "Ajout d'un appartement", "lesTypesApparts" => $lesTypesAppartements,"lesProprietaires"=>$lesProprietaires,"lesVilles"=>$lesVilles, "msg" => $msg]);
        }
    }
    public function modifListe(): void
    {
        // on crée une instance de AppartementRepository
        $unAppartRepository = new AppartementRepository();

        // on demande au modèle la liste des appartements
        $lesApparts = $unAppartRepository->getLesApparts();

        $this->render(ROOT . "/templates/Appartement/modifListe", ["title" => "Liste des appartements", "lesApparts" => $lesApparts]);
    }
    public function modifForm(): void
    {
        // on récupère l'appartement sélectionné dans la liste que l'utilisateur veut modifier
        $idAppart =  $_POST["lstApparts"];

        // on crée une instance de AppartementRepository
        $unAppartRepository = new AppartementRepository();

        // on demande au modèle l'appartement à modifier 
        $lAppart = $unAppartRepository->getUnAppartement($idAppart);

        // on doit récupèrer les types d'appartements pour alimenter la liste déroulante du formulaire
        // on crée une instance de AppartementRepository
        $typeAppartementRepository = new TypeAppartementRepository();
        $lesTypesApparts = $typeAppartementRepository->getLesTypes();

        $proprietaireRepository = new ProprietaireRepository();
        $lesProprietaires = $proprietaireRepository->getLesProprietaires();

        $villeRepository = new VilleRepository();
        $lesVilles = $villeRepository->getLesVilles();

        $this->render(ROOT . "/templates/Appartement/modif", ["title" => "Modification d'un appartement", "lesTypesApparts" => $lesTypesApparts,"lesProprietaires"=>$lesProprietaires,"lesVilles"=>$lesVilles, "lAppart" => $lAppart]);
    }

    public function modifTrait(): void
    {
        $lAppart = new Appartement(
            $_POST['idAppart'],
            $_POST['rue'],
            $_POST['batiment'],
            $_POST['etage'],
            $_POST['superficie'],
            $_POST['orientation'],
            $_POST['nb_pieces'],
            new TypeAppartement($_POST['lstTypeAppart'],null),
            new Proprietaire($_POST['lstProprietaires'],null,null,null,null,null,null,null),
            new Ville($_POST['lstVilles'],null,null)
        );
        // on crée une instance de AppartementRepository
        $unAppartRepository = new AppartementRepository();

        $ret = $unAppartRepository->modifAppartement($lAppart);
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : votre modification n'a pas été prise en compte</p>";
            // on réaffiche le formulaire 
        $typeAppartementRepository = new TypeAppartementRepository();
        $lesTypesApparts = $typeAppartementRepository->getLesTypes();

        $proprietaireRepository = new ProprietaireRepository();
        $lesProprietaires = $proprietaireRepository->getLesProprietaires();

        $villeRepository = new VilleRepository();
        $lesVilles = $villeRepository->getLesVilles();
            $this->render(ROOT . "/templates/Appartement/modif", array("title" => "Modification d'un appartement",  "lesTypesApparts" => $lesTypesApparts,"lesProprietaires"=>$lesProprietaires,"lesVilles"=>$lesVilles, "lAppart" => $lAppart, "msg" => $msg));
        } else {
            $msg = "<p class='text-success'>Votre modification a été enregistrée</p>";
            // on crée une instance de AppartementRepository
            $unAppartRepository = new AppartementRepository();

            // on demande au modèle la liste des appartements
            $lesApparts = $unAppartRepository->getLesApparts();

            $this->render(ROOT . "/templates/Appartement/modifListe", array("title" => "Liste des appartements", "lesApparts" => $lesApparts, "msg" => $msg));
        }
    }
    public function supprForm(): void
    {
       
            // Récupérez l'ID de l'appartement à supprimer
            $idAppart = $_POST["lstAppartsLibres"];
    
            // Créez une instance de AppartementRepository
            $unAppartRepository = new AppartementRepository();
    
            // Obtenez les détails de l'appartement à supprimer
            $lAppart = $unAppartRepository->getUnAppartement($idAppart);
    
            // Vérifiez si l'appartement a été trouvé
            if ($lAppart != null) {
                // Affichez la page de confirmation de suppression avec les détails de l'appartement
                $this->render(ROOT . "/templates/Appartement/suppression", array("title" => "Suppression d'un appartement", "lAppart" => $lAppart));
            } else {
                // Gérez le cas où l'appartement n'a pas été trouvé
                $msg = "<p class='text-danger'>L'appartement n'a pas été trouvé</p>";
                $this->render(ROOT . "/templates/Appartement/supprListe", array("title" => "Liste des appartements", "msg" => $msg));
            }
        } 
    
    
    public function supprListe(): void
    {
        // on crée une instance de AppartementRepository
        $unAppartRepository = new AppartementRepository();

        // on demande au modèle la liste des appartements
        $lesAppartsLibres = $unAppartRepository->getLesAppartsLibres();

        $this->render(ROOT . "/templates/Appartement/supprListe", array("title" => "Liste des appartements", "lesAppartsLibres" => $lesAppartsLibres));
    }
    public function supprTrait(): void
    {
        $lAppart = new Appartement(
            $_POST['idAppart'],
            null,
            null,
            null,
            null,
            null,
            null,
           null,
           null,
            null
        );
        // on crée une instance de AppartementRepository
        $unAppartRepository = new AppartementRepository();

        $ret = $unAppartRepository->supprAppartement($lAppart);
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : votre suppression n'a pas été prise en compte</p>";
            // on réaffiche le formulaire 
        $typeAppartementRepository = new TypeAppartementRepository();
        $lesTypesApparts = $typeAppartementRepository->getLesTypes();

        $proprietaireRepository = new ProprietaireRepository();
        $lesProprietaires = $proprietaireRepository->getLesProprietaires();

        $villeRepository = new VilleRepository();
        $lesVilles = $villeRepository->getLesVilles();
            $this->render(ROOT . "/templates/Appartement/suppression", array("title" => "Suppression d'un appartement",  "lesTypesApparts" => $lesTypesApparts,"lesProprietaires"=>$lesProprietaires,"lesVilles"=>$lesVilles, "lAppart" => $lAppart, "msg" => $msg));
        } else {
            $msg = "<p class='text-success'>Votre suppression a été enregistrée</p>";
            // on crée une instance de AppartementRepository
            $unAppartRepository = new AppartementRepository();

            // on demande au modèle la liste des appartements
            $lesApparts = $unAppartRepository->getLesApparts();

            $this->render(ROOT . "/templates/Appartement/supprListe", array("title" => "Liste des appartements", "lesApparts" => $lesApparts, "msg" => $msg));
        }
    }
    public function liste(): void
    {
        // on crée une instance de AppartementRepository
        $unAppart = new AppartementRepository();

        // on demande au modèle la liste des appartements
        $lesApparts = $unAppart->getLesApparts();

        // on passe les données à la vue pour qu'elle les affiche
        $this->render(ROOT . "/templates/Appartement/consultListe", array("title" => "Liste des appartements", "lesApparts" => $lesApparts));

    }
    public function listeAppartsLibres(): void
    {
        // on crée une instance de AppartementRepository
        $unAppart = new AppartementRepository();

        // on demande au modèle la liste des appartements
        $lesAppartsLibres = $unAppart->getLesAppartsLibres();

        // on passe les données à la vue pour qu'elle les affiche
        $this->render(ROOT . "/templates/Appartement/consultListeAppartLibres", array("title" => "Liste des appartements libres", "lesAppartsLibres" => $lesAppartsLibres));
    }
    
};