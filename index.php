<?php
include_once 'include/config.php'; 
include_once 'include/fonctions.php'; 

header('Content-Type: application/json;');
header('Access-Control-Allow-Origin: *'); 

$mysqli = new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données
if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue
  echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;
  exit();
} 

switch($_SERVER['REQUEST_METHOD'])
{
case 'GET':  // GESTION DES DEMANDES DE TYPE GET
	if(isset($_GET['id'])) { 
		if ($requete = $mysqli->prepare("SELECT * FROM forfaits_voyages WHERE id=?")) {  
		  $requete->bind_param("i", $_GET['id']); 
		  $requete->execute(); 

		  $resultat_requete = $requete->get_result(); 
		  $forfaitSQL = $resultat_requete->fetch_assoc(); 

		  // Convesion de l'objet au format JSON désiré
		  $forfaitObj = ConversionForfaitSQLEnObjet($forfaitSQL);

		  echo json_encode($forfaitObj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

		  $requete->close(); 
		}
	} else {
		$requete = $mysqli->query("SELECT * FROM forfaits_voyages");
		$listeForfaitsObj = [];

		while ($forfaitSQL = $requete->fetch_assoc()) {
			// Convesion de l'objet au format JSON désiré
			$forfaitObj = ConversionForfaitSQLEnObjet($forfaitSQL);

			// Ajout du Cégep à la liste
			array_push($listeForfaitsObj, $forfaitObj);
		}

		echo json_encode($listeForfaitsObj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		$requete->close();


		$requete = $mysqli->query("SELECT * FROM commentaires");
		$listeCommentairesObj = [];

		while ($commentaireSQL = $requete->fetch_assoc()) {
			// Convesion de l'objet au format JSON désiré
			$commentaireObj = ConversionCommentaireSQLEnObjet($commentaireSQL);

			// Ajout du Cégep à la liste
			array_push($listeCommentairesObj, $commentaireObj);
		}

		echo json_encode($listeCommentairesObj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		$requete->close();
	}
	break;
case 'POST':  // GESTION DES DEMANDES DE TYPE POST
	$reponse = new stdClass();
	$reponse->message = "Ajout d'un forfait: ";
	
	$corpsJSON = file_get_contents('php://input');
	$data = json_decode($corpsJSON, TRUE); 

	$destination = $data['destination'];
	$villeDepart = $data['villeDepart'];
	
	$nom = $data['hotel']['nom'];
	$coordonnees = $data['hotel']['coordonnees'];
	$nombreEtoiles = $data['hotel']['nombreEtoiles'];
	$nombreChambres = $data['hotel']['nombreChambres'];
	$caracteristiques = $data['hotel']['caracteristiques'];

	$dateDepart = $data['dateDepart'];	
	$dateRetour = $data['dateRetour'];

	$prix = $data['prix'];
	$rabais = $data['rabais'];
	$vedette = $data['vedette'];

	if(isset($destination) && isset($villeDepart) && isset($nom) && isset($coordonnees) && isset($nombreEtoiles) && isset($nombreChambres) && isset($caracteristiques) && isset($dateDepart) && isset($dateRetour) && isset($prix) && isset($rabais) && isset($vedette)) {
	  $caracteristiques_str = implode(';', $caracteristiques);

      if ($requete = $mysqli->prepare("INSERT INTO forfaits_voyages (destination, villeDepart, nom, coordonnees, nombreEtoiles, nombreChambres, caracteristiques, dateDepart, dateRetour, prix, rabais, vedette) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")) {      
		$requete->bind_param("ssssddsssdds", $destination, $villeDepart, $nom, $coordonnees, $nombreEtoiles, $nombreChambres, $caracteristiques_str, $dateDepart, $dateRetour, $prix, $rabais, $vedette);

        if($requete->execute()) { 
          $reponse->message .= "Succès";  
        } else {
          $reponse->message .=  "Erreur dans l'exécution de la requête";  
        }

        $requete->close(); 
      } else  {
        $reponse->message .=  "Erreur dans la préparation de la requête";  
      } 
    } else {
		$reponse->message .=  "Erreur dans le corps de l'objet fourni";  
	}
	echo json_encode($reponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	
	break;
case 'PUT':  // GESTION DES DEMANDES DE TYPE PUT

    	$reponse = new stdClass(); 
        $reponse->message = "Édition du forfait: ";     
	
		$corpsJSON = file_get_contents('php://input'); 
        $data = json_decode($corpsJSON, TRUE);

		$destination = $data['destination'];
		$villeDepart = $data['villeDepart'];
		
		$nom = $data['hotel']['nom'];
		$coordonnees = $data['hotel']['coordonnees'];
		$nombreEtoiles = $data['hotel']['nombreEtoiles'];
		$nombreChambres = $data['hotel']['nombreChambres'];
		$caracteristiques = $data['hotel']['caracteristiques'];

		$dateDepart = $data['dateDepart'];	
		$dateRetour = $data['dateRetour'];

		$prix = $data['prix'];
		$rabais = $data['rabais'];
		$vedette = $data['vedette'];
        
        if(isset($_GET['id'])) { 

            if(isset($destination) && isset($villeDepart) && isset($nom) && isset($coordonnees) && isset($nombreEtoiles) && isset($nombreChambres) && isset($caracteristiques) && isset($dateDepart) && isset($dateRetour) && isset($prix) && isset($rabais) && isset($vedette) && isset($_GET['id'])) {
				$caracteristiques_str = implode(';', $caracteristiques);

                if ($requete = $mysqli->prepare('UPDATE forfaits_voyages SET destination=?, villeDepart=?, nom=?, coordonnees=?, nombreEtoiles=?, nombreChambres=?, caracteristiques=?, dateDepart=?, dateRetour=?, prix=?, rabais=?, vedette=? WHERE id=?')) {

                    $requete->bind_param("ssssddsssddsi", $destination, $villeDepart, $nom, $coordonnees, $nombreEtoiles, $nombreChambres, $caracteristiques_str, $dateDepart, $dateRetour, $prix, $rabais, $vedette, $_GET['id']);

                    if($requete->execute()) { 
                        $reponse->message .= "Succès"; 
                    } else { 
                        $reponse->message .= "Erreur dans l'exécution de la requête"; 
                    } $requete->close();
                } else { 
                    $reponse->message .= "Erreur dans la préparation de la requête"; 
                } 
            } else { 
                $reponse->message .= "Erreur dans le corps de l'objet fourni"; 
            } 
        } else { 
            $reponse->message .= "Erreur dans les paramètres (aucun identifiant fourni)"; 
        } 
        print json_encode($reponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); 
    break; 

case 'DELETE':  // GESTION DES DEMANDES DE TYPE DELEET

	$reponse = new stdClass(); 
	$reponse->message = "Suppression du client: "; 

	if(isset($_GET['id'])) { 
		if ($requete = $mysqli->prepare('DELETE FROM forfaits_voyages WHERE id=?')) { 
			$requete->bind_param('i', $_GET['id']); 
			if($requete->execute()) { 
				$reponse->message .= "Succès"; 
			} else { 
				$reponse->message .= "Erreur dans l'exécution de la requête"; 
			} 
			$requete->close(); 
		} else { 
			$reponse->message .= "Erreur dans la préparation de la requête"; 
		} 
	} else { 
		$reponse->message .= "Erreur dans les paramètres (aucun identifiant fourni)"; 
	} 
	echo json_encode($reponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
break; 
}

$mysqli->close(); 
?>