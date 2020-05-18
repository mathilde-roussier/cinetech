<?php
include 'class/bdd.php';

session_start();

$bdd = new bdd();

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <!-- css boostrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- notre css -->
    <link rel="stylesheet" href="styles/style.css">

    <!-- notre js -->
    <script src='https://code.jquery.com/jquery-3.4.1.js'></script>
    <script src="js/cinetech.js"></script>

    <title> Mes favoris </title>
</head>

<body>

    <?php include 'include/header.php'; ?>

    <main class="container row col-12">

        <section class="container">
            <h2> Mes Favoris </h2>
            <div class="row col-12 justify-content-around" id="div_favori">
            </div>
        </section>
    </main>

    <?php include 'include/footer.php'; ?>

</body>

</html>