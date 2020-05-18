<?php

//NAV BAR CONNECTE
if (isset($_SESSION['id']))
{
?>
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="film.php">Films</a></li>
        <li class="nav-item"><a class="nav-link" href="serie.php">Séries</a></li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Compte</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="profil.php">Mon profil</a>
                <a class="dropdown-item" href="favoris.php">Mes favoris</a>
            </div>
        </li>
        <li class="nav-item"><a class="nav-link" href="deconnexion.php">Déconnexion</a></li>
    </ul>

<?php 

}
else
//NAV BAR NON CONNECTE
{

?>

    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="film.php">Films</a></li>
        <li class="nav-item"><a class="nav-link" href="serie.php">Séries</a></li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Compte</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="connexion.php">Connexion/inscription</a>
            </div>
        </li>
     </ul>

<?php 
 }
?>


