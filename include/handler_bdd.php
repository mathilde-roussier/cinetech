<?php
include("../class/bdd.php");

session_start();

if (!isset($bdd)) {
    $bdd = new bdd();
}

if (isset($_GET["function"])) {
    $function = $_GET["function"];

    switch ($function) {
        case "addfav":
            $id_media = $_GET["id"];
            $nom_media = htmlspecialchars($_GET["nom"]);
            $img_media = $_GET["img"];
            $type_media = $_GET["type"];
            $bdd->addfav($id_media, $nom_media, $type_media, $img_media);
            break;

        case "getfav":
            $bdd->getfav();
            break;

        case "supprfav":
            $id_media = $_GET["id"];
            $bdd->supprfav($id_media);
            break;
    }
}
