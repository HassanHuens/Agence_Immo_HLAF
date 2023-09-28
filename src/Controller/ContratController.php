<?php
/**
 * Summary of namespace App\Controller
 */
namespace App\Controller;

use App\Controller\Controller;
use App\Entity\Appartement;
use App\Entity\Contrat;
use App\Entity\Garant;
use App\Entity\Locataire;
use App\Entity\TypeLocation;
use App\Repository\AppartementRepository;
use App\Repository\ContratRepository;
use App\Repository\GarantRepository;
use App\Repository\LocataireRepository;
use App\Repository\TypeLocationRepository;
use DateTime;


/**
 * Summary of ContratController
 */
class ContratController extends Controller
{
    /**
     * Summary of __construct
     */
    public function __construct()
    {
        parent::__construct();
    }


    // fonction ajout d'un contrat

    /**
     * Summary of ajoutForm
     * @return void
     */
    public function ajoutForm(): void
    {
        // il faut demander au modèle la liste des locataires pour alimenter la liste déroulante
        $locataireRepository = new LocataireRepository();
        $lesLocataires = $locataireRepository->getLesLocataires();
        // il faut demander au modèle la liste des garants pour alimenter la liste déroulante
        $garantRepository = new GarantRepository();
        $lesGarants = $garantRepository->getLesGarants();
        // il faut demander au modèle la liste des appartements pour alimenter la liste déroulante
        $appartementRepository = new AppartementRepository();
        $lesApparts = $appartementRepository->getLesApparts();
        // il faut demander au modèle la liste des appartements pour alimenter la liste déroulante
        $typeLocationRepository = new TypeLocationRepository();
        $lesTypesLocation = $typeLocationRepository->getLesTypes();

        // on appelle la vue pour afficher le formulaire d'ajout d'un contrat
        $this->render(ROOT . "/templates/Contrat/ajout", ["title" => "Ajout d'un contrat", "lesLocataires" => $lesLocataires, "lesGarants" => $lesGarants, "lesApparts" => $lesApparts, "lesTypesLocation" => $lesTypesLocation]);
    }
    /**
     * Summary of ajoutTrait
     * @return void
     */
    public function ajoutTrait()
    {
        // on crée une instance de la classe Contrat à partir des données saisies sur le formulaire
        $unContrat = new Contrat(
            null,
            new DateTime($_POST['debut']),
            new DateTime($_POST['fin']),
            $_POST['montantCharges'],
            $_POST['montantCaution'],
            $_POST['montantLoyerHc'],
            $_POST['salaireLocataire'],
            new Locataire($_POST['lstLocataire']),
            new Garant($_POST['lstGarant']),
            new Appartement($_POST['lstAppartement'],null,null,null,null,null,null,null,null,null),
            new TypeLocation($_POST['lstTypeLocation'], null)
        );
        
        // on crée une instance de ContratRepository
        $unContratRepository = new ContratRepository();

        // on appelle la méthode qui permet d'ajouter le contrat
        // ret contient false si l'ajout n'a pas pu avoir lieu (erreur)
        // ret contient true si l'ajout s'est bien passé
        $ret = $unContratRepository->ajoutContrat($unContrat);

        // Réaffichage du formulaire (la vue Contrat/ajout)
        // ----------------------------------------------------
        // pour le formulaire, on récupère les locataires
        // il faut demander au modèle la liste des locataires pour alimenter la liste déroulante
        $locataireRepository = new LocataireRepository();
        $lesLocataires = $locataireRepository->getLesLocataires();
        // pour le formulaire, on récupère les garants
        // il faut demander au modèle la liste des garants pour alimenter la liste déroulante
        $garantRepository = new GarantRepository();
        $lesGarants = $garantRepository->getLesGarants();
        // pour le formulaire, on récupère les garants
        // il faut demander au modèle la liste des garants pour alimenter la liste déroulante
        $appartementRepository = new AppartementRepository();
        $lesApparts = $appartementRepository->getLesApparts();
        // pour le formulaire, on récupère les garants
        // il faut demander au modèle la liste des garants pour alimenter la liste déroulante
        $typeLocationRepository = new TypeLocationRepository();
        $lesTypesLocation = $typeLocationRepository->getLesTypes();
        // dans le formulaire, on affiche un message d'erreur ou un message de confirmation de l'ajout
        if ($ret == false) {
            // affichage d'un message d'erreur : le contrat n'a pas été ajouté on doit réafficher les données saisies (on passe un objet à la vue)
            $msg = "<p class='text-danger'>ERREUR : votre contrat n'a pas été enregistré</p>";
            $this->render(ROOT . "/templates/Contrat/ajout", ["title" => "Ajout d'un contrat", "msg" => $msg, "contrat" => $unContrat, "locataire" => $lesLocataires, "garant" => $lesGarants, "appartement" => $lesApparts, "lesTypesLocation" => $lesTypesLocation]);
        } else {
            // pas de problème : le contrat à été ajouté
            $msg = "<p class='text-success'>Votre contrat a été enregistré</p>";
            $this->render(ROOT . "/templates/Contrat/ajout", ["title" => "Ajout d'un contrat", "msg" => $msg, "locataire" => $lesLocataires, "garant" => $lesGarants, "appartement" => $lesApparts, "lesTypesLocation" => $lesTypesLocation]); 
        }
    }




    // fonction liste des contrats

    /**
     * Summary of liste
     * @return void
     */
    public function liste(): void
    {
        // on crée une instance de ContratRepository
        $unContrat = new ContratRepository();

        // on demande au modèle la liste des contrats
        $lesContrats = $unContrat->getLesContrats();

        // on passe les données à la vue pour qu'elle les affiche
        $this->render(ROOT . "/templates/Contrat/consultListe", array("title" => "Liste des contrats", "lesContrats" => $lesContrats));
    }


    // fonction modif d'un contrat
    /**
     * Summary of modifListe
     * @return void
     */
    public function modifListe(): void
    {
        // on crée une instance de ContratRepository
        $unContratRepository = new ContratRepository();
        // on demande au modèle la liste des contrats
        $lesContrats = $unContratRepository->getLesContrats();

        $this->render(ROOT . "/templates/Contrat/modifListe", array("title" => "Liste des contrats", "lesContrats" => $lesContrats));
    }

    /**
     * Summary of modifForm
     * @return void
     */
    public function modifForm(): void
    {
        // on récupère le contrat sélectionné par l'utilisateur dans la liste à modifier
        $idContrat =  $_POST["lstContrat"]; 
        // on crée une instance de ContratRepository
        $unContratRepository = new ContratRepository();
        // on demande au modèle le contrat à modifier 
        $leContrat = $unContratRepository->getUnContrat($idContrat);
 
        // on doit récupèrer les locataires pour alimenter la liste déroulante du formulaire
        // on crée une instance de LocataireRepository
        $LocataireRepository = new LocataireRepository();
        $lesLocataires = $LocataireRepository->getLesLocataires();
        // on doit récupèrer les Garants pour alimenter la liste déroulante du formulaire
        // on crée une instance de GarantRepository
        $GarantRepository = new GarantRepository();
        $lesGarants = $GarantRepository->getLesGarants();
        // on doit récupèrer les appartements pour alimenter la liste déroulante du formulaire
        // on crée une instance de AppartementRepository
        $AppartementRepository = new AppartementRepository();
        $lesApparts = $AppartementRepository->getLesApparts();
 
        $this->render(ROOT . "/templates/contrat/modif", ["title" => "Modification d'un appartement", "lesLocataires" => $lesLocataires, "lesGarants" => $lesGarants, "lesApparts" => $lesApparts, "leContrat" => $leContrat]);


    }
    /**
     * Summary of modifTrait
     * @return void
     */
    public function modifTrait(): void
    {
        $unContrat = new Contrat(
            null,
            new DateTime($_POST['debut']),
            new DateTime($_POST['fin']),
            $_POST['montantCharges'],
            $_POST['montantCaution'],
            $_POST['montantLoyerHc'],
            $_POST['salaireLocataire'],
            new Locataire($_POST['lstLocataire']),
            new Garant($_POST['lstGarant']),
            new Appartement($_POST['lstAppartement'],null,null,null,null,null,null,null,null,null)
        );
        // on crée une instance de ContratRepository
        $unContratRepository = new ContratRepository();

        $ret = $unContratRepository->modifContrat($unContrat);

        if ($ret == false) {

            $msg = "<p class='text-danger'>ERREUR : votre modification n'a pas été prise en compte</p>";
            // on réaffiche le formulaire 

            $LocataireRepository = new LocataireRepository();
            $lesLocataires = $LocataireRepository->getLesLocataires();

            $GarantRepository = new GarantRepository();
            $lesGarants = $GarantRepository->getLesGarants();

            $AppartementRepository = new AppartementRepository();
            $lesApparts = $AppartementRepository->getLesApparts();

            
            $this->render(ROOT . "/templates/Contrat/modif", [
                "title" => "Modification d'un contrat",  
                "lesLocataires" => $lesLocataires,
                "lesGarants" => $lesGarants,
                "lesApparts" => $lesApparts, 
                "unContrat" => $unContrat, 
                "msg" => $msg
            ]);

        } else {

            $msg = "<p class='text-success'>Votre modification a été enregistrée</p>";
            // on crée une instance de ContratRepository
            $unContratRepository = new ContratRepository();
 
            // on demande au modèle la liste des appartements
            $lesContrats = $unContratRepository->getLesContrats();
 
            $this->render(ROOT . "/templates/Appartement/modifListe", array("title" => "Liste des contrats", "lesContrats" => $lesContrats, "msg" => $msg));
        }
    }





    public function listeTypeLocation(): void
    {
        // on crée une instance de ContratRepository
        $unTypeLocation = new TypeLocationRepository();

        // on demande au modèle la liste des contrats
        $lesTypesLocation = $unTypeLocation->getLesTypes();

        // on passe les données à la vue pour qu'elle les affiche
        $this->render(ROOT . "/templates/Contrat/consultListeParType", ["title" => "Liste des types de location", "lesTypesLocation" => $lesTypesLocation]);
    }
    public function ListeContratUnTypeLocation(): void
    {
        // on récupère le contrat sélectionné par l'utilisateur dans la liste à modifier
        $idTypeLocation =  $_POST["lstTypeLocation"]; 
        // on crée une instance de ContratRepository
        $LesContratsRepository = new ContratRepository();
        // on demande au modèle le contrat à modifier 
        $lesContrats = $LesContratsRepository->getLesContratsUnTypeLocation($idTypeLocation);

        // on crée une instance de ContratRepository
        $unTypeLocation = new TypeLocationRepository();

        // on demande au modèle la liste des contrats
        $lesTypesLocation = $unTypeLocation->getLesTypes();

        // on passe les données à la vue pour qu'elle les affiche
        $this->render(ROOT . "/templates/Contrat/consultListeParType", ["title" => "Liste des contrats", "lesContrats" => $lesContrats, "lesTypesLocation" => $lesTypesLocation]);
    }
}   