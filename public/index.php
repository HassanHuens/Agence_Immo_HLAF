<?php

use App\Controller\AccueilController;
use App\Controller\AppartementController;
use App\Controller\ContratController;
use App\Controller\LocataireControlleur;
use App\Controller\TypeAppartementController;
use App\Controller\TypeLocationController;
use App\Controller\UtilisateurController;

require '../vendor/autoload.php';

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
if (isset($_GET['theme'])) {
	switch ($_GET['theme']) {
		case "appartement":
			// ----------------------------------------------------------------------------------
			// le paramètre thème contient appartement 
			// gestion des Appartements (on utiliske le contrôleur AppartementController.php ) -
			// ----------------------------------------------------------------------------------
			require(ROOT . "/src/Controller/AppartementController.php");
			$leControleur = new AppartementController();
			switch ($_GET['action']) {
					// ---------------------------------------------------------------
					// - la méthode appelée dépend du contenu du paramètre action -
					// -------------------------------------------------------------
				case "liste":
					// Affichage des caractéristiques de tous les appartements 
					$leControleur->liste();
					break;
				case "listeAppartsLibres":
					$leControleur->listeAppartsLibres();
					break;
				case "ajout":
					// Affichage du formulaire d'ajout d'un appartement
					$leControleur->ajoutForm();
					break;
				case "ajoutTrait":
					// traitement des données saisies sur le formulaire d'ajout d'un appartement
					// Vérification et enregistrement des informations saisies
					$leControleur->ajoutTrait();
					break;
				case "modif":
					// Affichage du formulaire qui liste des appartements en vue d'une modification
					$leControleur->modifListe();
					break;
				case "modifForm":
					// Affichage du formulaire de modification d'un appartement
					$leControleur->modifForm();
					break;
				case "modifTrait":
					// traitement des données saisies sur le formulaire de modification d'un appartement
					// Vérification et enregistrement des informations saisies
					$leControleur->modifTrait();
					break;
				case "suppression":
					// traitement des données saisies sur le formulaire de modification d'un appartement
					// Vérification et enregistrement des informations saisies
					$leControleur->supprListe();
					break;
				case "supprTrait":
					// traitement des données saisies sur le formulaire de modification d'un appartement
					// Vérification et enregistrement des informations saisies
					$leControleur->supprTrait();
					break;
				case "supprForm":
					// Affichage du formulaire de modification d'un appartement
					$leControleur->supprForm();
					break;
			}
			break;

		case 'categappart':
			$leControleur = new TypeAppartementController();
			switch ($_GET['action']) {
				case 'ajout':
					// Affichage du formulaire d'ajout d'une categorie
					$leControleur->ajoutForm();
					break;
				case 'ajoutTrait':
					// traitement des données saisies sur le formulaire d'ajout d'une categorie
					// Vérification et enregistrement des informations saisies
					$leControleur->ajoutTrait();
					break;
			}
			break;
				
		case "utilisateur":
			// ----------------------------------------------------------------------------------
			// - gestion des utilisateurs (on utilise le contrôleur UtilisateurController.php ) -
			// ----------------------------------------------------------------------------------
			require(ROOT . "/src/Controller/UtilisateurController.php");
			$leControleur = new UtilisateurController();

			switch ($_GET['action']) {
				case "ajout":
					// Affichage du formulaire d'ajout d'un utilisateur 
					$leControleur->ajoutForm();
					break;
				case "ajoutTrait":
					// traitement des données saisies sur le formulaire d'ajout d'un utilisateur
					// Vérification et enregistrement des informations saisies
					$leControleur->ajoutTrait();
					break;
				case "liste":
					// traitement des données saisies sur le formulaire d'ajout d'un utilisateur
					// Vérification et enregistrement des informations saisies
					$leControleur->liste();
					break;
			}
			break;

		case "connexion":
			// -------------------------------------------------------------------------------------------------
			// - gestion de la connexion à l'application (on utilise le contrôleur UtilisateurController.php ) -
			// -------------------------------------------------------------------------------------------------
			require(ROOT . "/src/Controller/UtilisateurController.php");
			$leControleur = new UtilisateurController();

			switch ($_GET['action']) {
				case "form":
					// Affichage du formulaire de connexion
					$leControleur->connexionForm();
					break;
				case "trait":
					// traitement des données saisies sur le formulaire de connexion
					// Vérification des informations saisies
					$leControleur->connexionTrait();
					break;
				default:
					// action contient une valeur non connue : on affiche la page d'accueil
					afficheAccueil();
					break;
			}
			break;
			case "locataire":
				// ----------------------------------------------------------------------------------
				// le paramètre thème contient appartement 
				// gestion des Appartements (on utilisle le contrôleur AppartementController.php ) -
				// ----------------------------------------------------------------------------------
				require(ROOT . "/src/Controller/locataireControlleur.php");
				$leControleur = new LocataireControlleur();
	
				switch ($_GET['action']) {
						// ---------------------------------------------------------------
						// - la méthode appelée dépend du contenu du paramètre action -
						// -------------------------------------------------------------
					case "liste":
						// Affichage des caractéristiques de tous les appartements 
						$leControleur->liste();
						break;
					case "ajout":
						// Affichage du formulaire d'ajout d'un appartement
						$leControleur->ajoutForm();
						break;
					case "ajoutTrait":
						// traitement des données saisies sur le formulaire d'ajout d'un appartement
						// Vérification et enregistrement des informations saisies
						$leControleur->ajoutTrait();
						break;
					case "modif":
						// Affichage du formulaire qui liste des appartements en vue d'une modification
						$leControleur->modifListe();
						break;
					case "modifForm":
						// Affichage du formulaire de modification d'un appartement
						$leControleur->modifForm();
						break;
					case "modifTrait":
						// traitement des données saisies sur le formulaire de modification d'un appartement
						// Vérification et enregistrement des informations saisies
						$leControleur->modifTrait();
						break;
	
					case "suppression":
							// Affichage du formulaire qui liste des appartements en vue d'une modification
						$leControleur->supprListe();
						break;
					case "supprForm":
							// Affichage du formulaire de modification d'un appartement
						$leControleur->supprForm();
						break;
					case "supprTrait":
							// traitement des données saisies sur le formulaire de modification d'un appartement
							// Vérification et enregistrement des informations saisies
						$leControleur->supprTrait();
						break;
				}
				break;

		case "contrat":
			// ----------------------------------------------------------------------------------
			// le paramètre thème contient contrat
			// gestion des Contrats (on utilise le contrôleur ContratController.php ) -
			// ----------------------------------------------------------------------------------
			require(ROOT . "/src/Controller/ContratController.php");
			$leControleur = new ContratController();
			switch ($_GET['action']) {
					// ---------------------------------------------------------------
					// - la méthode appelée dépend du contenu du paramètre action -
					// -------------------------------------------------------------
				case "ajout":
					// Affichage du formulaire d'ajout d'un contrat
					$leControleur->ajoutForm();
					break;
				case "ajoutTrait":
					// traitement des données saisies sur le formulaire d'ajout d'un contrat
					// Vérification et enregistrement des informations saisies
					$leControleur->ajoutTrait();
					break;
				case "liste":
					// Affichage des caractéristiques de tous les contrats 
					$leControleur->liste();
				case "modif":
					// Affichage du formulaire qui liste des appartements en vue d'une modification
					$leControleur->modifListe();
					break;
				case "modifForm":
					// Affichage du formulaire de modification d'un appartement
					$leControleur->modifForm();
					break;
				case "modifTrait":
					// traitement des données saisies sur le formulaire de modification d'un appartement
					// Vérification et enregistrement des informations saisies
					$leControleur->modifTrait();
					break;
				case "listeParType":
					// traitement des données saisies sur le formulaire de modification d'un appartement
					// Vérification et enregistrement des informations saisies
					$leControleur->listeTypeLocation();
					break;		
				case "listeParTypeTrait":
					// traitement des données saisies sur le formulaire de modification d'un appartement
					// Vérification et enregistrement des informations saisies
					$leControleur->ListeContratUnTypeLocation();
					break;	
			}
			break;
	}

} else {
	// action n'est pas fourni : on affiche la page d'accueil
	afficheAccueil();
}
function afficheAccueil()
{
	// on appelle le contrôleur AccueilControleur
	require(ROOT . "/src/Controller/AccueilController.php");
	session_start();
	session_destroy();
	session_start();
	$leControleur = new AccueilController();
	$leControleur->accueil();
}
