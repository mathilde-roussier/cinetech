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
    <meta charset="UTF-8">

    <!-- css boostrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">

    <!-- notre js -->
    <script src='https://code.jquery.com/jquery-3.4.1.js'></script>
    <script src="js/cinetech.js"></script>

    <title>Details</title>
</head>

<body>

    <?php include 'include/header.php'; ?>


    <main class="p-5">
        <section class="container-xl justify-content-around p-3">
            <div class="media">
                <?php if ($data_detail_decode['poster_path'] != null) { ?>
                    <img id="img_media"src="http://image.tmdb.org/t/p/w500<?php echo $data_detail_decode['poster_path']; ?>" class="mr-3" alt="...">
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
                        <?php } else {
                        if (!empty($data_detail_decode['episode_run_time'])) { ?>
                            <p><?php echo $data_detail_decode['episode_run_time'][0] . " min"; ?></p>
                    <?php }
                    } ?>
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

            <?php
            //RECOMMANDATIONS
            if (!empty($reco)) {
            ?>

                <div class="jumbotron jumbotron-fluid mt-4 text-center">
                    <div class="container">
                        <h1 class="display-4">Vous pourriez aussi aimer</h1>
                        <div class="row justify-content-around">

                            <?php
                            foreach ($reco as $title) {
                            ?>

                                <div id="<?php echo $title['id']; ?>" class="card col-3 p-0 m-2" style="width: 18rem;">
                                    <img src="<?php echo "https://image.tmdb.org/t/p/w500" . $title["poster_path"]; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $title['title']; ?></h5>
                                        <a href="details.php?id_film=<?php echo $title['id']; ?>" class="btn btn-primary">En voir plus</a>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php
            }
                ?>
        </section>
    </main>

    <?php include 'include/footer.php'; ?>

    <!--SCRIPTS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>