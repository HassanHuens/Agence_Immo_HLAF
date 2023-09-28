<?php

require '../vendor/autoload.php';
use App\Controller\AccueilController;
use App\Controller\locataireControlleur;
use App\Controller\AppartementController;
use App\Controller\UtilisateurController;

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
			$leControleur = new locataireControlleur();

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
			default:
			// action contient une valeur non connue : on affiche la page d'accueil
			afficheAccueil();
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
