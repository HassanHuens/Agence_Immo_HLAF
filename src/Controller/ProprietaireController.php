<?php
namespace App\Controller;


use App\Controller\Controller;
use App\Repository\ProprietaireRepository;

class ProprietaireController extends Controller
{
public function liste(): void
    {
        // on crée une instance de AppartementRepository
        $unProprio = new ProprietaireRepository();

        // on demande au modèle la liste des appartements
        $lesProprios = $unProprio->getLesProprietaires();

        // on passe les données à la vue pour qu'elle les affiche
        $this->render(ROOT . "/templates/Appartement/consultListe", ["title" => "Liste des proprietaires", "lesProprios" => $lesProprios]);

    }
};