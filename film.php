<?php
session_start();


include 'include/requete_film.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <!-- css boostrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/style.css">

    <!-- js boostrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <!-- notre js -->
    <script src='https://code.jquery.com/jquery-3.4.1.js'></script>
    <script src="js/cinetech.js"></script>

    <title>Film</title>
</head>

<body>

    <?php include 'include/header.php'; ?>

    <main class="container row col-12 justify-content-around">
        <section class='container row col-12 justify-content-around'>
            <?php
            foreach ($data_decode['results'] as $film) {
                $film = get_object_vars($film);
            ?>
                <div id="<?php echo $film['id']; ?>" class="card col-2 p-0 m-2" style="width: 18rem;">
                    <?php if ($film["poster_path"] != NULL) { ?>
                        <img src="<?php echo "https://image.tmdb.org/t/p/w500" . $film["poster_path"]; ?>" class="card-img-top" alt="...">
                    <?php } else { ?>
                        <img src="assets/no_img.jpg" class="card-img-top" alt="img non renseignee">
                    <?php } ?>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $film['vote_average']; ?></h6>
                        <h5 class="card-title"><?php echo $film['title']; ?></h5>
                        <a href="details.php?id_film=<?php echo $film['id']; ?>" class="btn btn-primary">En voir plus</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </section>

        <nav aria-label="..." style='overflow:auto' ;>
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <div id="nbpage<?php echo $data_decode['total_pages']; ?>" class="d-flex justify-content-center">
                    <?php for ($i = 1; $i <= ($data_decode['total_pages'] * 1 / 4); $i++) { ?>
                        <li id="<?php echo $i; ?>" <?php if ($i == 1) { ?>class="page-item active" <?php } else { ?> class="page-item" <?php } ?>><a id="p<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <li name="nop" class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">...</a>
                    </li>
                </div>
                <li class="page-item">
                    <a class="page-link">Next</a>
                </li>
            </ul>
        </nav>

    </main>

    <?php include 'include/footer.php'; ?>

</body>

</html>