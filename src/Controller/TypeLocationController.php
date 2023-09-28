<?php
namespace App\Controller;

use App\Controller\Controller;
use App\Repository\TypeLocationRepository;

class TypeLocationController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Summary of liste
     * @return void
     */
    
    // public function ajoutForm(): void
    // {
    //    // on appelle la vue pour afficher le formulaire d'ajout d'un categorie
    //     $this->render(ROOT . "/templates/Contrat/ajoutCategLocation", array("title" => "Ajout d'une categorie"));
    // }
    // public function ajoutTrait()
    // {
    //     // on crée une instance de la classe Categorie à partir des données saisies sur le formulaire
    //     $typeLocation = new TypeLocation(
    //         null,
    //         ($_POST['libelle']),
    //     );
    //     // on crée une instance de CategorieRepository
    //     $unTypeLocationRepository = new TypeLocationRepository();

    //     // on appelle la méthode qui permet d'ajouter la categorie
    //     // ret contient false si l'ajout n'a pas pu avoir lieu (erreur)
    //     // ret contient true si l'ajout s'est bien passé
    //     var_dump($typeLocation);
    //     $ret = $unTypeLocationRepository->ajoutCategLocation($typeLocation);

    //     // dans le formulaire, on affiche un message d'erreur ou un message de confirmation de l'ajout
    //     if ($ret == false) {
    //         // affichage d'un message d'erreur : la categorie n'a pas été ajouté on doit réafficher les données saisies (on passe un objet à la vue)
    //         $msg = "<p class='text-danger'>ERREUR : votre categorie de location n'a pas été enregistré</p>";
    //         $this->render(ROOT . "/templates/Contrat/ajoutCategLocation", array("title" => "Ajout d'une categorie", "msg" => $msg, "libelle" => $typeLocation));
    //     } else {
    //         // pas de  : la categorie n'a pas été ajouté
    //         $msg = "<p class='text-success'>Votre categorie de location a été enregistré</p>";
    //         $this->render(ROOT . "/templates/Contrat/ajoutCategLocation", array("title" => "Ajout d'une categorie", "msg" => $msg));
    //     }
    // }



}