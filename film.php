<?php
session_start();


include 'include/requete_film.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- css boostrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/style.css">

    <title>L'Animatek - Films</title>
</head>

<body>

    <?php include 'include/header.php'; ?>
    <main class="p-4 justify-content-around">
        <section class="container-xl row col-12 justify-content-around p-3 m-1">
        <h2 class="h2 text-center mb-4 mt-4"> Films </h2>

            <section id="catalogue" class="container row col-12 justify-content-around text-center">

                <?php
                foreach ($data_decode['results'] as $film) {
                    $film = get_object_vars($film);
                ?>
                    <div id="<?php echo $film['id']; ?>" class="card col-10 col-sm-8 col-md-4 col-lg-2 p-0 m-2">
                        <?php if ($film["poster_path"] != NULL) { ?>
                            <img src="<?php echo "https://image.tmdb.org/t/p/w500" . $film["poster_path"]; ?>" class="card-img-top" alt="...">
                        <?php } else { ?>
                            <img src="assets/no_img.jpg" class="card-img-top" alt="img non renseignee">
                        <?php } ?>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $film['vote_average']; ?> / 10</h6>
                            <h5 class="card-title"><?php echo $film['title']; ?></h5>
                            <a href="details.php?id_film=<?php echo $film['id']; ?>" class="btn btn-primary">En voir plus</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </section>

            <nav aria-label="..." style="overflow:auto;" class="mt-3">
                <ul class="pagination">
                    <div id="nbpage<?php echo $data_decode['total_pages']; ?>" class="d-flex justify-content-center">
                        <?php for ($i = 1; $i <= ($data_decode['total_pages'] * 1 / 4); $i++) { ?>
                            <li id="<?php echo $i; ?>" <?php if ($i == 1) { ?>class="page-item active" <?php } else { ?> class="page-item" <?php } ?>><a id="p<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
                        <?php } ?>
                        <li name="nop" class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">...</a>
                        </li>
                        <li id="<?php echo $data_decode['total_pages']; ?>" class="page-item">
                            <a id="p<?php echo $data_decode['total_pages']; ?>" class="page-link"><?php echo $data_decode['total_pages']; ?></a>
                        </li>
                    </div>
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