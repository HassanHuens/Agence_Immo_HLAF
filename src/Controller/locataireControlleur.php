<?php
namespace App\Controller;
use App\Entity\Locataire;
use App\Entity\Impression;
use App\Controller\Controller;
use App\Entity\Ville;
use App\Repository\VilleRepository;
use App\Repository\ProfilRepository;
use App\Repository\LocataireRepository;
use App\Repository\ImpressionRepository;
use App\Entity\CategorieSocioprofessionnelle;
use App\Repository\CategorieSocioprofessionnelleRepository;


class LocataireControlleur extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function connexionForm(): void
    {
        $this->render(ROOT . "/templates/locataire/connexion", array("title" => "Connexion"));
    }
    public function ajoutForm(): void
    {
		$villeRepository = new VilleRepository();
		$lesVilles = $villeRepository->getLesVilles();
        
        $categorieSocioprofessionelleRepository = new CategorieSocioprofessionnelleRepository();
		$lesCategPros = $categorieSocioprofessionelleRepository->getLesCategorieSocioprofessionnelles();

        $impressionRepository = new ImpressionRepository();
        $lesImps = $impressionRepository->getLesImpressions();


        $this->render(ROOT . "/templates/locataire/ajout",
         array("title" => "Ajout d'un locataire", 
         "lesImps" => $lesImps,
         "lesVilles" => $lesVilles,
         "lesCategPros" => $lesCategPros
        ));
    }
    public function ajoutTrait(): void
    {
        // on récupère l'id deconnecté
        session_start();

        // on génère le pseudo et le mot de passe
        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $email = trim($_POST['email']);
        $telephone = trim($_POST['telephone']);
        $rue = trim($_POST['rue']);;
        
        $unLocataire  = new Locataire(
            null,
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['telephone'],
            $_POST['rue'],
            new Ville($_POST['lstVille']),
            new Impression($_POST["lstImpression"]),
            new CategorieSocioprofessionnelle($_POST["lstCategorieSocioprofessionnelle"])
        );

        $locataireRepository = new LocataireRepository();
        $ret = $locataireRepository->ajoutLocataire($unLocataire);

        $villeRepository = new VilleRepository();
		$lesVilles = $villeRepository->getLesVilles();
        //creer une intance 
		$impressionRepository = new ImpressionRepository();
		$lesImps = $impressionRepository->getLesImpressions();


        $categorieSocioprofessionnelleRepository = new CategorieSocioprofessionnelleRepository();
		$lesCategPros = $categorieSocioprofessionnelleRepository->getLesCategorieSocioprofessionnelles();
        //if ($ret == false || trim($_POST['nom']) == "" || trim($_POST['prenom']) == "") {
		if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : le locataire n'a pas été enregistré</p>";
            $this->render(ROOT . "/templates/locataire/ajout", array("title" => "Ajout d'un locataire", "msg" => $msg, "unLocataire" => $unLocataire, "lesImps" => $lesImps, 
            "lesCategPros" => $lesCategPros,"lesVilles" => $lesVilles));
        } else {
            $msg = "<p class='text-success'>Le locataire a été enregistré</p>";
            $this->render(ROOT . "/templates/locataire/ajout", array("title" => "Ajout d'un locataire", "msg" => $msg, "lesImps" => $lesImps, 
            "lesCategPros" => $lesCategPros,"lesVilles" => $lesVilles));
        }
    }


    public function liste(): void
    {
        // on crée une instance de LocataireRepository
        $locataireRepository = new LocataireRepository();

        // on demande au modèle la liste des locataires
        $lesLocataires = $locataireRepository->getLesLocataires();

        // on passe les données à la vue pour qu'elle les affiche
        $this->render(ROOT . "/templates/Locataire/Liste", array("title" => "Liste des locataires", "lesLocataires" => $lesLocataires));
    }



    public function modifForm(): void
    {
        // on récupère le locataire sélectionné dans la liste que l'utilisateur veut modifier
        $idLocataire =  $_POST["lstLocataire"];

        // on crée une instance de LocataireRepository
        $locataireRepository = new LocataireRepository();

        // on demande au modèle le locataire à modifier 
        $unLocataire = $locataireRepository->getUnLocataire($idLocataire);

        // 
        $villeRepository = new VilleRepository();
        $lesVilles = $villeRepository->getLesVilles();
        
		$impressionRepository = new impressionRepository();
		$lesImps = $impressionRepository->getLesImpressions();

        $categorieSocioprofessionnelleRepository = new CategorieSocioprofessionnelleRepository();
		$lesCategPros = $categorieSocioprofessionnelleRepository->getLesCategorieSocioprofessionnelles();
        
        $this->render(ROOT . "/templates/Locataire/modif", 
        array("title" => "Modification d'un locataire",
        "unLocataire" => $unLocataire, 
        "lesImps" => $lesImps,
        "lesCategPros" => $lesCategPros,
        "lesVilles" => $lesVilles));
    }

    public function modifTrait(): void
    {
        $unLocataire  = new Locataire(
            null,
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['telephone'],
            $_POST['rue'],
            new Ville($_POST['lstVille']),
            new Impression($_POST["lstImpression"]),
            new CategorieSocioprofessionnelle($_POST["lstCategorieSocioprofessionnelle"])
        ); 

        // on crée une instance de LocataireRepository
        $unLocataireRepository = new LocataireRepository();

        $ret = $unLocataireRepository->modifLocataire($unLocataire);
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : votre modification n'a pas été prise en compte</p>";
            // on réaffiche le formulaire 

             $villeRepository = new VilleRepository();
            $lesVilles = $villeRepository->getLesVilles();
            //creer une intance 
            $impressionRepository = new ImpressionRepository();
            $lesImps = $impressionRepository->getLesImpressions();


            $categorieSocioprofessionnelleRepository = new CategorieSocioprofessionnelleRepository();
            $lesCategPros = $categorieSocioprofessionnelleRepository->getLesCategorieSocioprofessionnelles();


            $this->render(ROOT . "/templates/Locataire/modif", array("title" => "Modification d'un locataire", "lesImps" => $lesImps, 
            "lesCategPros" => $lesCategPros, "lesVilles" => $lesVilles, "leLocataire" => $unLocataire,   "msg" => $msg));
        } else {
            $msg = "<p class='text-success'>Votre modification a été enregistrée</p>";
            // on crée une instance de LocataireRepository
            $unLocataireRepository = new LocataireRepository();

            // on demande au modèle la liste des appartements
            $lesLocataires = $unLocataireRepository->getLesLocataires();

            $this->render(ROOT . "/templates/Locataire/modifListe", array("title" => "Liste des locataires", "lesLocataires" => $lesLocataires, "msg" => $msg));
        }
    }
    
}