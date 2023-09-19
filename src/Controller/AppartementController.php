<?php
namespace App\Controller;

use App\Entity\Appartement;
use App\Controller\Controller;
use App\Entity\TypeAppartement;
use App\Repository\AppartementRepository;
use App\Repository\TypeAppartementRepository;




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

        // on appelle la vue pour afficher le formulaire d'ajout d'un appartement
        $this->render(ROOT . "/templates/Appartement/ajout", array("title" => "Ajout d'un appartement", "lesTypesApparts" => $lesTypesAppartements));
    }
    public function ajoutTrait()
    {
        // on crée une instance de la classe Appartement à partir des données saisies sur le formulaire
        $appart = new Appartement(
            null,
            $_POST['superficie'],
            $_POST['orientation'],
            new TypeAppartement($_POST['lstTypeAppart'], null)
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
        // dans le formulaire, on affiche un message d'erreur ou un message de confirmation de l'ajout
        if ($ret == false) {
            // affichage d'un message d'erreur : l'appartement n'a pas été ajouté on doit réafficher les données saisies (on passe un objet à la vue)
            $msg = "<p class='text-danger'>ERREUR : votre appartement n'a pas été enregistré</p>";
            $this->render(ROOT . "/templates/Appartement/ajout", array("title" => "Ajout d'un appartement", "lesTypesApparts" => $lesTypesAppartements, "msg" => $msg, "lAppart" => $appart));
        } else {
            // pas de  : l'appartement n'a pas été ajouté
            $msg = "<p class='text-success'>Votre appartement a été enregistré</p>";
            $this->render(ROOT . "/templates/Appartement/ajout", array("title" => "Ajout d'un appartement", "lesTypesApparts" => $lesTypesAppartements, "msg" => $msg));
        }
    }
    public function modifListe(): void
    {
        // on crée une instance de AppartementRepository
        $unAppartRepository = new AppartementRepository();

        // on demande au modèle la liste des appartements
        $lesApparts = $unAppartRepository->getLesApparts();

        $this->render(ROOT . "/templates/Appartement/modifListe", array("title" => "Liste des appartements", "lesApparts" => $lesApparts));
    }
    public function modifForm(): void
    {
        // on récupère l'appartement sélectionné dans la liste que l'utilisateur veut modifier
        $idAppart =  $_POST["lstAppart"];

        // on crée une instance de AppartementRepository
        $unAppartRepository = new AppartementRepository();

        // on demande au modèle l'appartement à modifier 
        $lAppart = $unAppartRepository->getUnAppartement($idAppart);

        // on doit récupèrer les types d'appartements pour alimenter la liste déroulante du formulaire
        // on crée une instance de AppartementRepository
        $typeAppartementRepository = new TypeAppartementRepository();
        $lesTypes = $typeAppartementRepository->getLesTypes();

        $this->render(ROOT . "/templates/Appartement/modif", array("title" => "Modification d'un appartement", "lesTypesApparts" => $lesTypes, "lAppart" => $lAppart));
    }

    public function modifTrait(): void
    {
        $lAppart = new Appartement(
            $_POST['idAppart'],
            $_POST['superficie'],
            $_POST['orientation'],
            new TypeAppartement($_POST['lstTypeAppart'], null)
        );
        // on crée une instance de AppartementRepository
        $unAppartRepository = new AppartementRepository();

        $ret = $unAppartRepository->modifAppartement($lAppart);
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : votre modification n'a pas été prise en compte</p>";
            // on réaffiche le formulaire 
            $typeAppartementRepository = new TypeAppartementRepository();
            $lesTypes = $typeAppartementRepository->getLesTypes();
            $this->render(ROOT . "/templates/Appartement/modif", array("title" => "Modification d'un appartement",  "lesTypesApparts" => $lesTypes, "lAppart" => $lAppart, "msg" => $msg));
        } else {
            $msg = "<p class='text-success'>Votre modification a été enregistrée</p>";
            // on crée une instance de AppartementRepository
            $unAppartRepository = new AppartementRepository();

            // on demande au modèle la liste des appartements
            $lesApparts = $unAppartRepository->getLesApparts();

            $this->render(ROOT . "/templates/Appartement/modifListe", array("title" => "Liste des appartements", "lesApparts" => $lesApparts, "msg" => $msg));
        }
    }
    public function liste(): void
    {
        // on crée une instance de AppartementRepository
        $unAppartRepository = new AppartementRepository();

        // on demande au modèle la liste des appartements
        $lesApparts = $unAppartRepository->getLesApparts();

        // on passe les données à la vue pour qu'elle les affiche
        $this->render(ROOT . "/templates/Appartement/consultListe", array("title" => "Liste des appartements", "lesApparts" => $lesApparts));
    }
};
