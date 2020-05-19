<?php

session_start();

include 'include/requete_serie.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>L'Animatek - Séries</title>
</head>

<body>

    <?php include 'include/header.php'; ?>
    <main class="p-4">
        <section class="container-xl row col-12 justify-content-around p-3 m-1">
        <h2 class="h2 text-center mb-4 mt-4"> Séries </h2>

            <section id="catalogue" class="container row col-12 justify-content-around text-center">

                <?php
                foreach ($data_decode['results'] as $serie) {
                    $serie = get_object_vars($serie);
                ?>
                    <div id="<?php echo $serie['id']; ?>" class="card col-10 col-sm-8 col-md-4 col-lg-2 p-0 m-2">
                        <img src="<?php echo "https://image.tmdb.org/t/p/w500" . $serie["poster_path"]; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $serie['vote_average']; ?> / 10</h6>
                            <h5 class="card-title"><?php echo $serie['name']; ?></h5>
                            <a href="details.php?id_serie=<?php echo $serie['id']; ?>" class="btn btn-primary">En voir plus</a>
                        </div>
                    </div>
                <?php
                }

                ?>
            </section>

            <nav aria-label="..." style='overflow:auto;' class="mt-3">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $data_decode['total_pages']; $i++) { ?>
                        <li id="<?php echo $i; ?>" <?php if ($i == 1) { ?>class="page-item active" <?php } else { ?> class="page-item" <?php } ?>><a id="p<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
                    <?php } ?>
                </ul>
            </nav>
        </section>

    </main>

    <?php include 'include/footer.php'; ?>

    <!--SCRIPTS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script src="js/cinetech.js"></script>
</body>

</html>