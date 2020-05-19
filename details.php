<?php

if (isset($_GET['id_serie'])) {
    include 'include/requete_serie.php';
    include 'include/recommandations_serie.php';

    // var_dump($_GET['id_serie']);
}

if (isset($_GET['id_film'])) {
    include 'include/requete_film.php';
    include 'include/recommandations_film.php';

    // var_dump($_GET['id_film']);
}

include 'class/bdd.php';

session_start();

$bdd = new bdd();

foreach ($_GET as $champ => $info) {
    $type_media = $champ;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- notre css -->
    <link rel="stylesheet" href="styles/style.css">

    <!-- css boostrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- js boostrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- notre js -->
    <script src='https://code.jquery.com/jquery-3.4.1.js'></script>
    <script src="js/cinetech.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <title>L'Animatek - Détails</title>
</head>

<body>

    <?php include 'include/header.php'; ?>

    <main class="p-4">
        <section class="container-xl justify-content-around p-3 align-center text-center">
            <?php if ($data_detail_decode['poster_path'] != null) { ?>
                <img id="img_media" src="http://image.tmdb.org/t/p/w500<?php echo $data_detail_decode['poster_path']; ?>" class="mr-3 img-fluid" alt="...">
            <?php } else { ?>
                <img src="assets/no_img.jpg" class="mr-3 img-fluid" alt="...">
            <?php } ?>

            <div>
                <?php if ($champ == 'id_film') { ?>
                    <h5 class="mt-0 display-4"><?php echo $data_detail_decode['title']; ?></h5>
                <?php } else { ?>
                    <h5 class="mt-0 display-4"><?php echo $data_detail_decode['name']; ?></h5>
                <?php } ?>
                <aside>Note : <?php echo $data_detail_decode['vote_average']; ?> / 10</aside>
            </div>
            <p><?php echo $data_detail_decode['overview']; ?></p>
            <?php if ($champ == 'id_film') { ?>
                <p>Durée : <?php echo $data_detail_decode['runtime'] . " min"; ?></p>
                <?php } else {
                if (!empty($data_detail_decode['episode_run_time'])) { ?>
                    <p><?php echo $data_detail_decode['episode_run_time'][0] . " min"; ?></p>
            <?php }
            } ?>
            <p><?php foreach ($data_detail_decode['genres'] as $genres) {
                    echo get_object_vars($genres)['name'] . " | ";
                } ?></p>
            <?php if ($champ == 'id_film') { ?>
                <p>Sortie : <?php echo $data_detail_decode['release_date']; ?></p>
            <?php } else { ?>
                <p>Première diffusion : <?php echo $data_detail_decode['first_air_date'] . " | Dernière diffusion : " . $data_detail_decode['last_air_date']; ?></p>
                <p>Nombre de saison(s) : <?php echo $data_detail_decode['number_of_seasons']; ?></p>
                <p>Nombre d'épisode(s) : <?php echo $data_detail_decode['number_of_episodes']; ?></p>
            <?php } ?>

            <p>Acteur(s) : <?php if (count($data_credit_decode['cast']) > 2) {
                                for ($i = 0; $i <= 2; $i++) {
                                    echo get_object_vars($data_credit_decode['cast'][$i])['name'] . " , ";
                                }
                            ?>
                    etc...</p>
        <?php
                            } elseif (empty($data_credit_decode['cast'])) { ?>
            non communiquées.</p>
        <?php } else {
                                foreach ($data_credit_decode['cast'] as $cast) {
                                    echo get_object_vars($cast)['name'] . " , ";
                                } ?>
            etc..</p>
        <?php
                            } ?>
        <?php if ($champ == 'id_film') { ?>
            <p>Réalisateur(s) : <?php foreach ($data_credit_decode['crew'] as $crew) {
                                    if (get_object_vars($crew)['job'] == 'Director') {
                                        echo get_object_vars($crew)['name'] . " , ";
                                    }
                                } ?></p>
        <?php } else { ?>
            <p>Producteur(s) : <?php foreach ($data_detail_decode['created_by'] as $creator) {
                                    echo get_object_vars($creator)['name'] . " , ";
                                }
                            } ?></p>

            <?php if (isset($_SESSION['id'])) {
                $bdd->checkfav($info);
            } else { ?>
                <a href="connexion.php" class="btn btn-primary">Ajouter aux favoris</a>

            <?php } ?>

            <?php
            //RECOMMANDATIONS
            if (!empty($reco)) {
            ?>

                <div class="jumbotron jumbotron-fluid mt-4 text-center">
                    <div class="container">
                        <h4 class="display-4">Vous pourriez aussi aimer</h4>
                        <div class="row justify-content-around">

                            <?php
                            foreach ($reco as $title) {
                                if ($champ == 'id_film') {
                            ?>
                                    <div id="<?php echo $title['id']; ?>" class="card col-10 col-sm-10 col-md-6 col-lg-3 p-0 m-2">
                                        <img src="<?php echo "https://image.tmdb.org/t/p/w500" . $title["poster_path"]; ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $title['title']; ?></h5>
                                            <a href="details.php?id_film=<?php echo $title['id']; ?>" class="btn btn-primary">En voir plus</a>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div id="<?php echo $title['id']; ?>" class="card col-10 col-sm-10 col-md-6 col-lg-3 p-0 m-2">
                                        <img src="<?php echo "https://image.tmdb.org/t/p/w500" . $title["poster_path"]; ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $title['name']; ?></h5>
                                            <a href="details.php?id_serie=<?php echo $title['id']; ?>" class="btn btn-primary">En voir plus</a>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php
            }
                ?>

                <!-- Espace Commentaire -->

                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">Espace commentaires</h1>
                        <hr>
                        <div id="comments">
                            <?php if (!empty($data_reviews_decode['results'])) {
                                foreach ($data_reviews_decode['results'] as $review) {
                            ?>
                                    <div id="<?php echo $data_reviews_decode['id']; ?>" class="border border-secondary shadow p-3 mb-5 rounded">
                                        <p><?php echo get_object_vars($review)['author'] . " =>"; ?></p>
                                        <p><?php echo get_object_vars($review)['content']; ?></p>
                                    </div>
                            <?php }
                            }; ?>
                        </div>

                        <?php include 'commentaire.php' ?>
                    </div>
                </div>

        </section>

    </main>

    <?php include 'include/footer.php'; ?>
    
</body>

</html>