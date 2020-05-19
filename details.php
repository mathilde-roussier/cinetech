<?php

if (isset($_GET['id_serie'])) {
    include 'include/requete_serie.php';
    // var_dump($_GET['id_serie']);
}

if (isset($_GET['id_film'])) {
    include 'include/requete_film.php';
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
    <meta charset="UTF-8">

    <!-- css boostrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- notre js -->
    <script src='https://code.jquery.com/jquery-3.4.1.js'></script>
    <script src="js/cinetech.js"></script>

    <title>Details</title>
</head>

<body>

    <main class="container">

        <section>

            <div class="media">
                <?php if ($data_detail_decode['poster_path'] != null) { ?>
                    <img src="http://image.tmdb.org/t/p/w500<?php echo $data_detail_decode['poster_path']; ?>" class="mr-3" alt="...">
                <?php } else { ?>
                    <img src="assets/no_img.jpg" class="mr-3" alt="...">
                <?php } ?>

                <div class="media-body">
                    <div class="d-flex justify-content-between">
                        <?php if ($champ == 'id_film') { ?>
                            <h5 class="mt-0"><?php echo $data_detail_decode['title']; ?></h5>
                        <?php } else { ?>
                            <h5 class="mt-0"><?php echo $data_detail_decode['name']; ?></h5>
                        <?php } ?>
                        <aside><?php echo $data_detail_decode['vote_average']; ?> / 10</aside>
                    </div>
                    <p><?php echo $data_detail_decode['overview']; ?></p>
                    <?php if ($champ == 'id_film') { ?>
                        <p><?php echo $data_detail_decode['runtime'] . " min"; ?></p>
                    <?php } else { ?>
                        <p><?php echo $data_detail_decode['episode_run_time'][0] . " min"; ?></p>
                    <?php } ?>
                    <p><?php foreach ($data_detail_decode['genres'] as $genres) {
                            echo get_object_vars($genres)['name'] . " | ";
                        } ?></p>
                    <?php if ($champ == 'id_film') { ?>
                        <p><?php echo $data_detail_decode['release_date']; ?></p>
                    <?php } else { ?>
                        <p><?php echo $data_detail_decode['first_air_date'] . " | " . $data_detail_decode['last_air_date']; ?></p>
                        <p>Season(s) : <?php echo $data_detail_decode['number_of_seasons']; ?></p>
                        <p>Episode(s) : <?php echo $data_detail_decode['number_of_episodes']; ?></p>
                    <?php } ?>

                    <p>Stars : <?php if (count($data_credit_decode['cast']) > 2) {
                                    for ($i = 0; $i <= 2; $i++) {
                                        echo get_object_vars($data_credit_decode['cast'][$i])['name'] . " , ";
                                    }
                                ?>
                            etc..</p>
                <?php
                                } elseif (empty($data_credit_decode['cast'])) { ?>
                    non communiquées.</p>
                <?php } else {
                                    foreach ($data_credit_decode['cast'] as $cast) {
                                        echo get_object_vars($cast)['name'] . " , ";
                                    } ?>
                    etc..</p>
                <?php
                                    // echo get_object_vars($data_credit_decode['cast'][0])['name'] . " , ";
                                } ?>
                <?php if ($champ == 'id_film') { ?>
                    <p>Director(s) : <?php foreach ($data_credit_decode['crew'] as $crew) {
                                            if (get_object_vars($crew)['job'] == 'Director') {
                                                echo get_object_vars($crew)['name'] . " , ";
                                            }
                                        } ?></p>
                <?php } else { ?>
                    <p>Creator(s) : <?php foreach ($data_detail_decode['created_by'] as $creator) {
                                        echo get_object_vars($creator)['name'] . " , ";
                                    }
                                } ?></p>

                    <?php if (isset($_SESSION['id'])) {
                        $bdd->checkfav($info);
                    } else { ?>
                        <a href="connexion.php" class="btn btn-primary">Ajouter aux favoris</a>

                    <?php } ?>

                </div>
            </div>
        </section>

        <!-- Espace Commentaire -->

        <section>
            <div id="addcomment" class="d-flex col-3 justify-content-between">
                <textarea placeholder='Commentaire...'></textarea>
                <button class="btn btn-primary">Valider</button>
            </div>

            <?php var_dump($data_reviews_decode); ?>

        </section>

    </main>

</body>

</html>