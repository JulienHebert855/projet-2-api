<?php

// Cette fonction prend l'object au format tablulaire SQL 
// et retourne un objet dont la structure correspond au format
// devant être retourné par l'API. 
function ConversionForfaitSQLEnObjet($forfaitSQL) {
    $forfaitOBJ = new stdClass();
    $forfaitOBJ->destination = $forfaitSQL["destination"];

    $forfaitOBJ->villeDepart = $forfaitSQL["villeDepart"];

    $forfaitOBJ->hotel = new stdClass();
    $forfaitOBJ->hotel->nom = $forfaitSQL["nom"];
    $forfaitOBJ->hotel->coordonnees = $forfaitSQL["coordonnees"];
    $forfaitOBJ->hotel->nombreEtoiles = $forfaitSQL["nombreEtoiles"];
    $forfaitOBJ->hotel->nombreChambres = $forfaitSQL["nombreChambres"];
    $forfaitOBJ->hotel->caracteristiques = explode (";", $forfaitSQL["caracteristiques"]);

    $forfaitOBJ->dateDepart = $forfaitSQL["dateDepart"];

    $forfaitOBJ->dateRetour = $forfaitSQL["dateRetour"];

    $forfaitOBJ->prix = $forfaitSQL["prix"];

    $forfaitOBJ->rabais = $forfaitSQL["rabais"];

    $forfaitOBJ->vedette = $forfaitSQL["vedette"];

    return $forfaitOBJ;

} 

?>
